/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package processing;

import com.pi4j.io.serial.Serial;
import com.pi4j.io.serial.SerialFactory;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.concurrent.TimeUnit;
import java.util.logging.Level;
import java.util.logging.Logger;
import org.json.simple.JSONObject;
import php.PhpClass;
import settings.Settings;
import studenttracking.BusTracking;
import studenttracking.ClassPeriod;

/**
 *
 * @author mustafa
 */
public class GPS implements Runnable {

     private static final Serial serial = SerialFactory.createInstance();
     
     public static float lat;
     public static float lon;
     public int schoolno;
     public int busno;
     private BusTracking bstk;
     
     public GPS(int busno,int schoolno)
     {
         this.busno = busno;
         this.schoolno = schoolno;
         System.out.println(busno + " " + schoolno);
     }
     
     public GPS(BusTracking bstk)
     {
         this.bstk = bstk;
     }
     
     public void sendbuslocation(float lat,float lon)
     {
                JSONObject Jsonobj = new JSONObject();
                Jsonobj.put("schoolno",bstk.schoolno);
                Jsonobj.put("busno",bstk.busno);
                Jsonobj.put("lat",lat);
                Jsonobj.put("lon",lon);
                Jsonobj.put("latlondate", Settings.getCurrentDate());
                Jsonobj.put("latlontime", Settings.getCurrentTime());
                Jsonobj.put("tripstate", bstk.getTripStateTime());               
                
                String json = Jsonobj.toJSONString();
                
                //System.out.println(Settings.getUrl() + "sendbusgps.php?busgps="+json);

                try {
                    PhpClass.insertRow(Settings.getUrl() + "sendbusgps.php?busgps="+json);
                } catch (IOException ex) {
                    Logger.getLogger(ClassPeriod.class.getName()).log(Level.SEVERE, null, ex);
                }
                System.out.println("GPS Info has sent                   \r");
            
                System.out.println(lat + "," + lon);
     }
     
     public void gpsreading() throws IOException, InterruptedException
     {
       System.out.println("Open");
       serial.open( "/dev/ttyUSB0",  9600 );
       
        InputStream in = serial.getInputStream();
        BufferedReader rd = new BufferedReader(new InputStreamReader(in));
     
        String line;
       
        float latgps;
        int latdeg;
        float latmin;
        //float lat;
        
        float longps;
        int londeg;
        float lonmin;
        //float lon;
        //rd.wait(10);
        long stop=System.nanoTime()+TimeUnit.SECONDS.toNanos(10);
        while ((line = rd.readLine()) != null) {
                    //System.out.println(line);
            String data[]= line.split(",");
            if (data[0].equals("$GPRMC"))
            {
                if (data[2].equals("A"))
                {
                   latgps = Float.parseFloat(data[3]);
                   if (data[4] == "S")
                       latgps = latgps * -1;
                            
                    latdeg = (int) latgps/100;
                    latmin = latgps - latdeg * 100;
                    lat = latdeg+(latmin/60);

                    longps = Float.parseFloat(data[5]);
                    if (data[6].equals("W"))
                        longps =  longps * -1;

                    londeg = (int) longps/100;
                    lonmin = longps - londeg * 100;
                    lon = londeg + (lonmin/60);
                    
                    //System.out.println("-----------------------------");
                    //System.out.println((data[3] + "," + data[5]));
                    
                    //Thread.sleep(15000);
                    
                    if (stop<System.nanoTime()) {
                        //System.out.println("===============================");
                        //System.out.println(lat + "," + lon);
                        stop=System.nanoTime()+TimeUnit.SECONDS.toNanos(10);
                        //System.out.println("===============================");
                        sendbuslocation(lat,lon);
                    }
                }
            }
                    
                    
           }
        rd.close();        
        
        serial.close();
   }
    

    
    public void run() {
        
        
        while(true)
        {
            try {
                gpsreading();
            } catch (IOException ex) {
                Logger.getLogger(GPS.class.getName()).log(Level.SEVERE, null, ex);
            } catch (InterruptedException ex) {
                Logger.getLogger(GPS.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
        
 
    }
    

    
}
