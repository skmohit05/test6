package com.example.admin.test3;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ListView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class Pickup extends AppCompatActivity {
    String json_string;
    JSONObject jsonObject;
    JSONArray jsonArray;
    PickupContactAdapter pickupContactAdapter;
    ListView listView;
    SessionManager session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pickup);
        session = new SessionManager(getApplicationContext());
        session.checkLogin();
        listView = (ListView)findViewById(R.id.listview);
        pickupContactAdapter = new PickupContactAdapter(this, R.layout.row_layout_pickup);
        listView.setAdapter(pickupContactAdapter);
        json_string =  getIntent().getExtras().getString("json_data");
        try {
            jsonObject = new JSONObject(json_string);
            jsonArray = jsonObject.getJSONArray("result");
            int count=0;
            String name,address,phone,mobile;
            while(count<jsonArray.length()){
                JSONObject JO = jsonArray.getJSONObject(count);
                name = JO.getString("name");
                address = JO.getString("address");
                mobile = JO.getString("mobile");

                PickupContacts pickupContacts = new PickupContacts(name,address,mobile);
                pickupContactAdapter.add(pickupContacts);
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

    public void getDelivery(View view){
        BackgroundWorkerDPD backgroundWorkerDPD = new BackgroundWorkerDPD(this);
        backgroundWorkerDPD.execute("delivery");
    }

    public void getPickup(View view){
        BackgroundWorkerDPD backgroundWorkerDPD = new BackgroundWorkerDPD(this);
        backgroundWorkerDPD.execute("pickup");
    }

}
