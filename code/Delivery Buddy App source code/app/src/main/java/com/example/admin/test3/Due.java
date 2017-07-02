package com.example.admin.test3;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;

public class Due extends AppCompatActivity {
    JSONObject jsonObject;
    JSONArray jsonArray;
    String json_string;
    SessionManager session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_due);
        session = new SessionManager(getApplicationContext());
        session.checkLogin();
        // get user data from session
        String user = session.getUserDetails();

        json_string =  getIntent().getExtras().getString("json_data");
        try {
            jsonObject = new JSONObject(json_string);
            jsonArray = jsonObject.getJSONArray("result");
            int count=0;
            String name,deliveries,amount;
            while(count<jsonArray.length()){
                JSONObject JO = jsonArray.getJSONObject(count);
                name = JO.getString("name");
                if(name.equals(user)) {
                    deliveries = JO.getString("deliveries");
                    amount = JO.getString("amount");
                    TextView textView1 = (TextView)findViewById(R.id.deliveries);
                    textView1.setText(deliveries);
                    TextView textView2 = (TextView)findViewById(R.id.amount);
                    textView2.setText(amount);
                }
                count++;
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    public void getPickup(View view){
        BackgroundWorkerDPD backgroundWorkerDPD = new BackgroundWorkerDPD(this);
        backgroundWorkerDPD.execute("pickup");
    }

    public void getDelivery(View view){
        BackgroundWorkerDPD backgroundWorkerDPD = new BackgroundWorkerDPD(this);
        backgroundWorkerDPD.execute("delivery");
    }

    public void getDue(View view){
        BackgroundWorkerDPD backgroundWorkerDPD = new BackgroundWorkerDPD(this);
        backgroundWorkerDPD.execute("due");
    }

    public void onLogout(View view){
        SessionManager session = new SessionManager(getApplicationContext());
        session.logoutUser();
    }

    public void onHome(View view){
        startActivity(new Intent(this,MainActivity.class));
    }

}
