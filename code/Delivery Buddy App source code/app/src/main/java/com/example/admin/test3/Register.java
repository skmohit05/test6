package com.example.admin.test3;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

public class Register extends AppCompatActivity {
    EditText name, email, username, phone, address, aadharPanId, password, confirmpassword;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        name = (EditText)findViewById(R.id.name);
        email = (EditText)findViewById(R.id.email);
        username = (EditText)findViewById(R.id.username);
        phone = (EditText)findViewById(R.id.phone);
        address = (EditText)findViewById(R.id.address);
        aadharPanId = (EditText)findViewById(R.id.aadharpPanId);
        password = (EditText)findViewById(R.id.password);
        confirmpassword = (EditText)findViewById(R.id.confirmpassword);
    }

    public void OnReg(View view){
        String str_name = name.getText().toString();
        String str_email = email.getText().toString();
        String str_username = username.getText().toString();
        String str_phone = phone.getText().toString();
        String str_address = address.getText().toString();
        String str_aadharPanId = aadharPanId.getText().toString();
        String str_password = password.getText().toString();
        String str_confpassword = confirmpassword.getText().toString();
        String emailPattern = "[a-zA-Z0-9._-]+@[a-z]+\\.+[a-z]+";
        if (str_name.matches("") || str_email.matches("") || str_username.matches("") || str_phone.matches("") || str_address.matches("") || str_aadharPanId.matches("") || str_password.matches("")) {
            Toast.makeText(this, "Input field can not be empty", Toast.LENGTH_SHORT).show();
        }
        else {
            if (str_email.matches(emailPattern))
            {
                if(str_password.equals(str_confpassword)){
                    String type = "register";
                    BackgroundWorkerLR backgroundWorkerLR = new BackgroundWorkerLR(this);
                    backgroundWorkerLR.execute(type, str_name, str_email, str_username, str_phone, str_address, str_aadharPanId, str_password);
                }
                else {
                    Toast.makeText(this, "Password don't match", Toast.LENGTH_LONG).show();
                }
            }
            else
            {
                Toast.makeText(getApplicationContext(),"Invalid email address", Toast.LENGTH_SHORT).show();
            }
        }
    }

    public void Login(View view){
        startActivity(new Intent(this,Login.class));
    }
}

