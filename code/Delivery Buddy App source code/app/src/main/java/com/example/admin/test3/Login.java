package com.example.admin.test3;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

public class Login extends AppCompatActivity {
    EditText UsernameEt, PasswordEt;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        UsernameEt = (EditText)findViewById(R.id.etUserName);
        PasswordEt = (EditText)findViewById(R.id.etPassword);
    }

    @Override
    protected void onResume() {
        super.onResume();
        BackgroundWorkerDPD backgroundWorkerDPD = new BackgroundWorkerDPD(this);
        backgroundWorkerDPD.execute("session");
    }

    public void OnLogin(View view) {
        String username = UsernameEt.getText().toString();
        String password = PasswordEt.getText().toString();
        if(username.length() > 0 && password.length() > 0){
            String type = "login";
            BackgroundWorkerLR backgroundWorkerLR = new BackgroundWorkerLR(this);
            backgroundWorkerLR.execute(type, username, password);
        }
        else {
            Toast.makeText(this, "Please enter your username and password !", Toast.LENGTH_LONG).show();
        }
    }

    public void OpenReg(View view){
        startActivity(new Intent(this,Register.class));
    }
}
