/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package settings;

import java.io.File;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

/**
 *
 * @author mustafa
 */
/**
 *
 * @author mustafa
 */
public class Settings {
    
        public static String settingfilename;
        //public static String Url ="http://localhost:8888/StudentTracking/";
        public static String Url = "http://stdtraking.esy.es/tracker/";
        public static String getUrl()
        {
            return Url;
        }
        
        
        public static String getCurrentTime()
        {
            Calendar cal = Calendar.getInstance();
            SimpleDateFormat sdf = new SimpleDateFormat("hh:mm:ss");
            return ((String)  sdf.format(cal.getTime()));
        }
        
        public static String getCurrentDate() 
        {
           
            DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
            //System.out.print(dateFormat.format(new Date()));
            return dateFormat.format(new Date()).toString();
            
        }
        
        

        

        

        
        
        public static boolean IsFileexists(String filename)
        {
            File f = new File(filename);
            if(f.exists() && !f.isDirectory()) { 
                return true;
            }
            
            return false;
        }
        
}
