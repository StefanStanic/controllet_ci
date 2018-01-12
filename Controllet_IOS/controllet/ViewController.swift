//
//  ViewController.swift
//  controllet
//
//  Created by Stefan Stanic on 1/12/18.
//  Copyright © 2018 Stefan Stanic. All rights reserved.
//

import UIKit
import WebKit
class ViewController: UIViewController {
    @IBOutlet weak var MyWebView: WKWebView!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        let url=URL(string:"Https://controllet.000webhostapp.com");
        MyWebView.load(URLRequest(url:url!));
        // Do any additional setup after loading the view, typically from a nib.
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }


}

