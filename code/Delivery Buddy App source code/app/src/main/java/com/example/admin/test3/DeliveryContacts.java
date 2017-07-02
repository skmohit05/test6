package com.example.admin.test3;

/**
 * Created by admin on 19-05-2017.
 */

public class DeliveryContacts {
    private String name, address, time,mobile;

    public DeliveryContacts(String name, String address, String time, String mobile){
        this.setName(name);
        this.setAddress(address);
        this.setTime(time);
        this.setMobile(mobile);
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getTime() {
        return time;
    }

    public void setTime(String time) {
        this.time = time;
    }

    public String getMobile() {
        return mobile;
    }

    public void setMobile(String mobile) {
        this.mobile = mobile;
    }

}
