package com.example.admin.test3;

import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AlertDialog;
import android.widget.Toast;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

/**
 * Created by admin on 17-05-2017.
 */

public class BackgroundWorkerDPD extends AsyncTask<String,Void,String> {
    String JSON_STRING;
    String type2;
    Context context;
    AlertDialog alertDialog;
    BackgroundWorkerDPD(Context ctx) {
        context = ctx;
    }
    @Override
    protected String doInBackground(String... params) {
        String type = params[0];
        type2 = type;
        String due_url = "http://10.0.2.2/delivery/getMembers.php";
        String pickup_url = "http://10.0.2.2/delivery/getPickup.php";
        String delivery_url = "http://10.0.2.2/delivery/getDelivery.php";
        if(type.equals("due")) {
            try {
                URL url = new URL(due_url);
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
        }
        else if(type.equals("pickup")){
            try {
                URL url = new URL(pickup_url);
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
        }
        else if(type.equals("delivery")){
            try {
                URL url = new URL(delivery_url);
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
        }

        return null;
    }

    @Override
    protected void onPreExecute() {

    }

    @Override
    protected void onPostExecute(String result) {
        JSON_STRING = result;
        if(type2.equals("due")){
            if(JSON_STRING == null){
                Toast.makeText(context, "No data found", Toast.LENGTH_LONG).show();
            }
            else {
                Intent intent = new Intent(context, Due.class);
                intent.putExtra("json_data", JSON_STRING);
                context.startActivity(intent);
            }
        }
        else if(type2.equals("pickup")){
            if(JSON_STRING == null){
                Toast.makeText(context, "No data found", Toast.LENGTH_LONG).show();
            }
            else {
                Intent intent = new Intent(context, Pickup.class);
                intent.putExtra("json_data", JSON_STRING);
                context.startActivity(intent);
            }
        }
        else if(type2.equals("delivery")){
            if(JSON_STRING == null){
                Toast.makeText(context, "No data found", Toast.LENGTH_LONG).show();
            }
           else {
                Intent intent = new Intent(context, Delivery.class);
                intent.putExtra("json_data", JSON_STRING);
                context.startActivity(intent);
            }
        }
    }

    @Override
    protected void onProgressUpdate(Void... values) {
        super.onProgressUpdate(values);
    }
}
