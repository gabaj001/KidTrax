/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package php;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLConnection;

/**
 *
 * @author mustafa
 */
public class PhpClass {
    
    
        public static BufferedReader LoadData(String Url) {

            try {
               
                URL url = new URL(Url);

                URLConnection conn = url.openConnection();

                // Get the response
                return  new BufferedReader(new InputStreamReader(conn.getInputStream()));
                
                
              } catch (Exception e) {
                e.printStackTrace();
              }
            
            return null;
        }
        

    public static void insertRow(String Url) throws IOException
    {
        URL url = new URL(Url);
         //System.out.println(Url);
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        if( conn.getResponseCode() == HttpURLConnection.HTTP_OK ){
            InputStream is = conn.getInputStream();
            
           /*println(line);
                    
            }
            rd.close();*/
        // do something with the data here
        }else{
            InputStream err = conn.getErrorStream();
            //System.out.println(Url);
        // err may have useful information.. but could be null see javadocs for more information
        }
    }
    
}

