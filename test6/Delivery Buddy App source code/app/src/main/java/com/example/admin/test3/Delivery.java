package com.example.admin.test3;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class Delivery extends AppCompatActivity {
    String json_string,json_string2;
    JSONObject jsonObject;
    JSONArray jsonArray;
    DeliveryContactAdapter deliveryContactAdapter;
    ListView listView;
    SessionManager session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_delivery);
        session = new SessionManager(getApplicationContext());
        session.checkLogin();
        // get user data from session
        String user = session.getUserDetails();
        listView = (ListView)findViewById(R.id.listview);
        deliveryContactAdapter = new DeliveryContactAdapter(this, R.layout.row_layout_delivery);
        listView.setAdapter(deliveryContactAdapter);
        json_string =  getIntent().getExtras().getString("json_data");
        new BackgroundTask().execute();
        json_string2 =  getIntent().getExtras().getString("json_data2");
        try {
            jsonObject = new JSONObject(json_string);
            jsonArray = jsonObject.getJSONArray("result");
            int count=0;
            String name,address,mobile,time,delivery_person;
            while(count<jsonArray.length()){
                JSONObject JO = jsonArray.getJSONObject(count);
                delivery_person = JO.getString("delivery_person");
                if(delivery_person.equals(user)){
                    name = JO.getString("name");
                    address = JO.getString("address");
                    time = JO.getString("delivery_time");
                    mobile = JO.getString("mobile");
                    DeliveryContacts deliveryContacts = new DeliveryContacts(name,address,time,mobile);
                    deliveryContactAdapter.add(deliveryContacts);
                }

                count++;
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }

    }

    public void getDue(View view){
        BackgroundWorkerDPD backgroundWorkerDPD = new BackgroundWorkerDPD(this);
        backgroundWorkerDPD.execute("due");
    }

    public void getPickup(View view){
        BackgroundWorkerDPD backgroundWorkerDPD = new BackgroundWorkerDPD(this);
        backgroundWorkerDPD.execute("pickup");
    }

    public void getDelivery(View view){
        BackgroundWorkerDPD backgroundWorkerDPD = new BackgroundWorkerDPD(this);
        backgroundWorkerDPD.execute("delivery");
    }


    class BackgroundTask extends AsyncTask<Void, Void, String> {

        String members_url, JSON_STRING;

        @Override
        protected void onPreExecute() {
            members_url = "http://10.0.2.2/delivery/getMembers.php";;
        }

        @Override
        protected String doInBackground(Void... params) {
            try {
                URL url = new URL(members_url);
                HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
                InputStream inputStream = httpURLConnection.getInputStream();
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));
                StringBuilder stringBuilder = new StringBuilder();
                while((JSON_STRING = bufferedReader.readLine()) != null){
                    stringBuilder.append(JSON_STRING+"\n");
                }
                bufferedReader.close();
                inputStream.close();
                httpURLConnection.disconnect();
                return stringBuilder.toString().trim();
            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e){
                e.printStackTrace();
            }

            return null;
        }

        @Override
        protected void onProgressUpdate(Void... values) {
            super.onProgressUpdate(values);
        }

        @Override
        protected void onPostExecute(String result) {
            JSON_STRING = result;
                if(JSON_STRING == null){
                    Toast.makeText(getBaseContext(), "No data found", Toast.LENGTH_LONG).show();
                }
                else {
                    getIntent().putExtra("json_data2", JSON_STRING);
                }
            }

    }

}
