/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package studenttracking;

import java.io.IOException;
import java.util.Hashtable;
import java.util.Scanner;
import java.util.logging.Level;
import java.util.logging.Logger;
import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import php.PhpClass;
import settings.ReadJSON;
import settings.Settings;
import settings.WriteJSON;

/**
 *
 * @author mustafa
 */
public class StudentActivity extends Tracking {
           
            protected String placename;
            
            public StudentActivity(){}
            
            
            public void initialSetting()
            {
               Settings.settingfilename = "actsettings.json";
               super.initialSetting(Settings.settingfilename);
            }
            
            public void sentStudentInfoTracking(String studentrifdtag) 
            {

                JSONObject Jsonobj = new JSONObject();
                

                Jsonobj.put("placename", placename.replace(" ", "%20"));
                Jsonobj.put("activitytime", Settings.getCurrentTime());
                Jsonobj.put("activitydate", Settings.getCurrentDate());
                Jsonobj.put("timeState", scanningTimeState());
                Jsonobj.put("studentrifdtag", studentrifdtag);
                Jsonobj.put("schoolno", schoolno);
                
                
               
                String json = Jsonobj.toJSONString();

                try {
                    PhpClass.insertRow(Settings.getUrl() + "StudentActivity.php?studentactivity="+json);
                    //System.out.println(Settings.getUrl() + "StudentActivity.php?studentActivity="+json);
                    System.out.println("Student Info has sent");
                } catch (IOException ex) {
                    Logger.getLogger(StudentActivity.class.getName()).log(Level.SEVERE, null, ex);
                }
                
            }

    
    
    @Override
    public StudentActivity currentperiod()
    {
            return this;
    }

    
    @Override
    public void readstudent(String studentRFIDTag) {
        
        sentStudentInfoTracking(studentRFIDTag);
        
    }
    
    
    @Override
    public void InputSettingValue()
    {
        
        Hashtable<String,String> activitySetting=new Hashtable<String,String>();
        
        Scanner scanner = new Scanner(System.in);
        System.out.println("\nEnter The Following Setting Information");
        System.out.print("School Number...........: - ");
        schoolno = Integer.parseInt(scanner.nextLine());
        activitySetting.put("schoolno", "" + schoolno);
        
        System.out.print("Place Description.......: - ");
        placename = scanner.nextLine();
        activitySetting.put("description", placename);
        
        
        System.out.print("Do You Want Save This Information (Y/N) :- ");
        
        String save= scanner.nextLine().toUpperCase();
        if(save.equals("Y")) {
            WriteJSON.writejson("ActivityDetails", activitySetting);
            System.out.println("The Setting Updated");
        }
        
        activitySetting.clear();
       
         
                 
    }

    @Override
    public void loadsetting() {
        
        
              JSONArray list = ReadJSON.readjson(Settings.settingfilename);
                    
                   
             
              list.forEach( act -> getActivityDetails( (JSONObject) act ) );
   
    }
    
    
    private  void getActivityDetails(JSONObject Activity) 
    {
            
		
		JSONObject ActivityObject = (JSONObject) Activity.get("ActivityDetails");
                
                
                System.out.println("\nTracking System Information ");
	        schoolno = Integer.parseInt((String) ActivityObject.get("schoolno"));	
		System.out.println("School Number...........: - " + schoolno);
                
                placename = (String) ActivityObject.get("description");	
		System.out.println("Place Description.......: - " + placename);
                
                System.out.print("Do you want change this setting (Y/N) :- ");
                Scanner scanner = new Scanner(System.in);
                String save= scanner.nextLine().toUpperCase();
        
                if(save.equals("Y")) {
                    InputSettingValue();
                }
                
	
    }

    
}
    
    
            
   
    

