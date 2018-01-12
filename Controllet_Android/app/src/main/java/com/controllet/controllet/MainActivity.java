package com.controllet.controllet;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Window;
import android.view.WindowManager;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        //Remove title bar
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);

        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);

        setContentView(R.layout.activity_main);



        WebView controllet = (WebView)findViewById(R.id.web1);
        WebSettings webSettings = controllet.getSettings();
        webSettings.setJavaScriptEnabled(true);
        controllet.setWebViewClient(new WebViewClient());
        controllet.loadUrl("https://controllet.000webhostapp.com/");
    }
}
