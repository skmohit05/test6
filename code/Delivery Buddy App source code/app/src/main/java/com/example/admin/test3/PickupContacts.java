package com.example.admin.test3;

/**
 * Created by admin on 17-05-2017.
 */

public class PickupContacts {
    private String name, address, mobile;

    public PickupContacts(String name, String address, String mobile){
        this.setName(name);
        this.setAddress(address);
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

    public String getMobile() {
        return mobile;
    }

    public void setMobile(String mobile) {
        this.mobile = mobile;
    }

}
