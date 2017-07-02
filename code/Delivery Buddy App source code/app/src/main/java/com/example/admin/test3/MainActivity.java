package com.example.admin.test3;

import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
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

public class MainActivity extends AppCompatActivity {

    SessionManager session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


        session = new SessionManager(getApplicationContext());

        session.checkLogin();

        // get user data from session
        String user = session.getUserDetails();


        TextView textView = (TextView)findViewById(R.id.textView);
        textView.setText(user);

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
        session.logoutUser();
    }

}
