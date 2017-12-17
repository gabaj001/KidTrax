/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package studenttracking;

import java.io.File;
import java.time.LocalTime;
import java.util.Hashtable;
import java.util.LinkedList;
import java.util.Map;
import java.util.Queue;
import java.util.Scanner;
import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import settings.ReadJSON;
import settings.Settings;
import settings.WriteJSON;

/**
 *
 * @author mustafa
 */

public class GateTracking  extends StudentActivity {
    
    
    
    private String arrivingstarttime;
    private String arrivingendtime;
    private String departurestarttime;
    private String departureendtime;
    
    //private String filename;
    
    
    
    public GateTracking()
    {
       Settings.settingfilename = "gtgettings.json";
       super.initialSetting(Settings.settingfilename);
       //loadsetting ();
     
    }
    
   
    
    
    
    public void InputSettingValue()
    {
        
        Hashtable<String,String> gateSetting=new Hashtable<String,String>();
        
        Scanner scanner = new Scanner(System.in);
        System.out.println("\nEnter The Following Setting Information");
        System.out.print("School Number...................: - ");
        schoolno = Integer.parseInt(scanner.nextLine());
        gateSetting.put("schoolno", "" + schoolno);
        
        System.out.print("Gate Description................: - ");
        placename = scanner.nextLine();
        gateSetting.put("gatedescription", placename);
        
        System.out.print("Arriving Start Time (hh:mm:ss)..: - ");
        arrivingstarttime = scanner.nextLine();
        gateSetting.put("arrivingstarttime", arrivingstarttime);
        
        System.out.print("Arriving End Time (hh:mm:ss)....: - ");
        arrivingendtime = scanner.nextLine();
        gateSetting.put("arrivingendtime", arrivingendtime);
        
        System.out.print("Departure Start Time (hh:mm:ss).: - ");
        departurestarttime = scanner.nextLine();
        gateSetting.put("departurestarttime", departurestarttime);
        
        System.out.print("Departure End Time (hh:mm:ss)...: - ");
        departureendtime = scanner.nextLine();
        gateSetting.put("departureendtime", departureendtime);
        
        System.out.print("Do You Want Save This Information (Y/N) :- ");
        
        String save= scanner.nextLine().toUpperCase();
        if(save.equals("Y")) {
            WriteJSON.writejson("GateDetails", gateSetting);
            System.out.println("The Setting Updated");
        }
        
        gateSetting.clear();
       
         
                 
    }
        
        
    public void loadsetting ()
    {
        
      JSONArray list = ReadJSON.readjson(Settings.settingfilename);

      list.forEach( gt -> getGateDetails( (JSONObject) gt ) );
      
    }
 
    

    
    
    private  void getGateDetails(JSONObject Gate) 
    {
            
		
		JSONObject GateObject = (JSONObject) Gate.get("GateDetails");
                
                
                System.out.println("\nTracking System Information ");
	        schoolno = Integer.parseInt((String) GateObject.get("schoolno"));	
		System.out.println("School Number...................: - " + schoolno);
                
                placename = (String) GateObject.get("gatedescription");	
		System.out.println("Gate Description................: - " + placename);
                
		
		arrivingstarttime = (String) GateObject.get("arrivingstarttime");	
		System.out.println("Arriving Start Time (hh:mm:ss)..: - " + arrivingstarttime);
		
		
		arrivingendtime = (String) GateObject.get("arrivingendtime");	
		System.out.println("Arriving End Time (hh:mm:ss)....: - " + arrivingendtime);
		
		
		departurestarttime = (String) GateObject.get("departurestarttime");	
		System.out.println("Departure Start Time (hh:mm:ss).: - " + departurestarttime);
                
                departureendtime = (String) GateObject.get("departureendtime");	
		System.out.println("Departure End Time (hh:mm:ss)...: - " + departureendtime);
                
                System.out.print("Do you want change this setting (Y/N) :- ");
                Scanner scanner = new Scanner(System.in);
                String save= scanner.nextLine().toUpperCase();
        
                if(save.equals("Y")) {
                    
                    InputSettingValue();
                    
                } 
                
	}

    
    
    public int scanningTimeState()
    {
            LocalTime start = LocalTime.parse(this.starttime );
            LocalTime end = LocalTime.parse(this.arrivingstarttime);          
            Boolean t1 = LocalTime.now().isAfter( start );
            Boolean t2 = LocalTime.now().isBefore( end );
            
            if ((t1 && t2)==true) return 1; // Before Arriving time
    
            start = LocalTime.parse(this.arrivingstarttime);
            end = LocalTime.parse(this.arrivingendtime);           
            Boolean t3 = LocalTime.now().isAfter( start );
            Boolean t4 = LocalTime.now().isBefore( end );
            
            if ((t3 && t4)==true) return 2; // Arriving on time
            
            start = LocalTime.parse(this.arrivingendtime);
            end = LocalTime.parse(this.departurestarttime);           
            Boolean t5 = LocalTime.now().isAfter( start );
            Boolean t6 = LocalTime.now().isBefore( end ); 
            
            if ((t5 && t6)==true) return 3; // Late
           
            start = LocalTime.parse(this.departurestarttime);
            end = LocalTime.parse(this.departureendtime);           
            Boolean t7 = LocalTime.now().isAfter( start );
            Boolean t8 = LocalTime.now().isBefore( end );  
            
            if ((t7 && t8)==true) return 4; // Departure on time
            
            start = LocalTime.parse(this.departureendtime);
            end = LocalTime.parse(this.endtime);            
            Boolean t9 = LocalTime.now().isAfter( start );
            Boolean t10 = LocalTime.now().isBefore( end );  
            
            if ((t9 && t10)==true) return 5; // After departure time
            
            
            return 0;
            
           
            
    }    
    
    
 }
