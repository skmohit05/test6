package com.example.admin.test3;

import android.content.Context;
import android.support.annotation.LayoutRes;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by admin on 19-05-2017.
 */

public class DeliveryContactAdapter extends ArrayAdapter {
    List list = new ArrayList();

    public DeliveryContactAdapter(@NonNull Context context, @LayoutRes int resource) {
        super(context, resource);
    }


    public void add(DeliveryContacts object) {
        super.add(object);
        list.add(object);
    }

    @Override
    public int getCount() {
        return  list.size();
    }

    @Nullable
    @Override
    public Object getItem(int position) {
        return list.get(position);
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        View row;
        row = convertView;
        ContactHolder contactHolder;
        if(row==null){
            LayoutInflater layoutInflater = (LayoutInflater)this.getContext().getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            row = layoutInflater.inflate(R.layout.row_layout_delivery,parent,false);
            contactHolder = new ContactHolder();
            contactHolder.tx_name = (TextView)row.findViewById(R.id.tx_name);
            contactHolder.tx_address = (TextView)row.findViewById(R.id.tx_address);
            contactHolder.tx_time = (TextView)row.findViewById(R.id.tx_time);
            contactHolder.tx_phone = (TextView)row.findViewById(R.id.tx_phone);
            row.setTag(contactHolder);
        }
        else {
            contactHolder = (ContactHolder)row.getTag();

        }

        DeliveryContacts deliveryContacts = (DeliveryContacts)this.getItem(position);
        contactHolder.tx_name.setText(deliveryContacts.getName());
        contactHolder.tx_address.setText(deliveryContacts.getAddress());
        contactHolder.tx_time.setText(deliveryContacts.getTime());
        contactHolder.tx_phone.setText(deliveryContacts.getMobile());
        return row;
    }

    static class ContactHolder {
        TextView tx_name,tx_address,tx_time,tx_phone;

    }
}

