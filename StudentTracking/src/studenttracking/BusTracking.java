/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package studenttracking;

import java.io.BufferedReader;
import java.io.IOException;
import java.time.LocalTime;
import java.util.Hashtable;
import java.util.Scanner;
import java.util.logging.Level;
import java.util.logging.Logger;
import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import org.json.simple.parser.JSONParser;
import org.json.simple.parser.ParseException;
import php.PhpClass;
import processing.GPS;
import settings.ReadJSON;
import settings.Settings;
import settings.WriteJSON;

/**
 *
 * @author mustafa
 */
public class BusTracking extends Tracking {

    public int busno;
    private String description;
    private String schooltripstarttime;
    private String schooltripendtime;
    private String hometripstarttime;
    private String hometripendttime;
    
    
    private  Hashtable<String, String> studentMap  = new Hashtable<String, String>();
    
    BusTracking()
    {
        Settings.settingfilename = "bussetting.json";
        super.initialSetting(Settings.settingfilename);
        LoadBusInfo();
    }
    
    
    public   void LoadBusInfo()
    {
            JSONObject Jsonobj = new JSONObject();

            Jsonobj.put("schoolno", schoolno);
            Jsonobj.put("busno", busno);
            String json = Jsonobj.toJSONString();

            
            String Url = Settings.getUrl() + "schoolbusinfo.php?bus="+json;
            
          

           JSONParser jsonParser = new JSONParser();
           
           BufferedReader rd = PhpClass.LoadData(Url);
           try {
                Object obj = jsonParser.parse(rd);
                JSONArray busInfo = (JSONArray) obj;
                if (busInfo.isEmpty())
                    System.out.println("There Is No Data In Database "
                            + "Compatible "
                            + "With Traking Systsem ");
            //System.out.println(busInfo);
            
            rd.close();
            
            busInfo.forEach( info -> parsebusInfo( (JSONObject) info ) );
                
           } catch (IOException ex) {
               Logger.getLogger(BusTracking.class.getName()).log(Level.SEVERE, null, ex);
           } catch (ParseException ex) {
               Logger.getLogger(BusTracking.class.getName()).log(Level.SEVERE, null, ex);
           }
           
    }
    
    	private   void parsebusInfo(JSONObject busInfo) 
	{
                JSONObject info = (JSONObject) busInfo;
		
		int schoolno = Integer.parseInt((String) info.get("SchoolNo"));	
                //System.out.println(schoolno);
                
		int StudentID = Integer.parseInt((String) info.get("studentid"));	
		//System.out.println(StudentID);
                
                String studentRFIDTag = (String) info.get("studentRFIDTag");	
                //System.out.println(studentRFIDTag);
                
                studentMap.put(studentRFIDTag,"" + StudentID);
        }

    
    
    @Override
    public void InputSettingValue() {
        
        Hashtable<String,String> busSetting=new Hashtable<String,String>();
        
        Scanner scanner = new Scanner(System.in);
        System.out.println("\nEnter The Following Setting Information");
        
        System.out.print("Shool Number ..........: - ");
        schoolno = Integer.parseInt(scanner.nextLine());
        busSetting.put("schoolno", "" + schoolno);
        
        System.out.print("Bus Number ............: - ");
        busno = Integer.parseInt(scanner.nextLine());
        busSetting.put("busno", "" + busno);
               
        
        System.out.print("School Trip Start Time.: - ");
        schooltripstarttime = scanner.nextLine();
        busSetting.put("schooltripstarttime", schooltripstarttime);
        
        System.out.print("School Trip End Time...: - ");
        schooltripendtime = scanner.nextLine();
        busSetting.put("schooltripendtime", schooltripendtime);
        
        
        System.out.print("Home Trip Start Time...: - ");
        hometripstarttime = scanner.nextLine();
        busSetting.put("hometripstarttime", hometripstarttime);
        
        
        System.out.print("Home Trip End Time.....: - ");
        hometripendttime = scanner.nextLine();
        busSetting.put("hometripendttime", hometripendttime);
        
        
        System.out.print("Description............: - ");
        description = scanner.nextLine();
        busSetting.put("description", description);
        
        
        System.out.print("Do You Want Save This Information (Y/N) :- ");
        
        String save= scanner.nextLine().toUpperCase();
        
        if(save.equals("Y")) {
            
            WriteJSON.writejson("BusDetails", busSetting);
            
            System.out.println("\nThe Setting Updated");
            
        }
        
        busSetting.clear();
       
         

    }
    
     public void sentStudentInfoTracking(String studentID) 
     {
                JSONObject Jsonobj = new JSONObject();
                
                
                Jsonobj.put("time_attendance", Settings.getCurrentTime());
                Jsonobj.put("date_ttendance", Settings.getCurrentDate());
                Jsonobj.put("studentid", studentID);
                Jsonobj.put("schoolno", schoolno);
                Jsonobj.put("busno", busno);
                Jsonobj.put("trip_state", getTripStateTime());
                Jsonobj.put("lat",GPS.lat );
                Jsonobj.put("lon",GPS.lon );
                
                String json = Jsonobj.toJSONString();

                try {
                    PhpClass.insertRow(Settings.getUrl() + "insertstudentbusattd.php?studentattendance="+json);
                } catch (IOException ex) {
                    Logger.getLogger(ClassPeriod.class.getName()).log(Level.SEVERE, null, ex);
                }
                System.out.println("Student Info has sent                   \r");
            

     }
     
    public void readstudent(String studentRFIDTag) {
        
            String studentID = studentMap.get(studentRFIDTag);
            if (studentID!=null) {
                sentStudentInfoTracking(studentID);
                //System.out.println(studentRFIDTag);
            } else {
                    alert();
            }
        
    }

    @Override
    public void loadsetting() {
        
              JSONArray list = ReadJSON.readjson(Settings.settingfilename);

              list.forEach( cls -> getBusDetails( (JSONObject) cls ) );
    
    }
    
    
    private  void getBusDetails(JSONObject bus) 
    {
            
		
		JSONObject busObject = (JSONObject) bus.get("BusDetails");
                
                System.out.println("\nTracking System Information ");
	        schoolno = Integer.parseInt((String) busObject.get("schoolno"));	
		System.out.println("Shool Number ..........: - " + schoolno);
                
                busno = Integer.parseInt((String) busObject.get("busno"));	
		System.out.println("Bus Number ............: - " + busno);
                
                
                schooltripstarttime = (String) busObject.get("schooltripstarttime");
                System.out.println("School Trip Start Time.: - " + schooltripstarttime);
        
                schooltripendtime = (String) busObject.get("schooltripendtime");
                System.out.println("School Trip End Time...: - " + schooltripendtime);
        
                hometripstarttime = (String) busObject.get("hometripstarttime");
                System.out.println("Home Trip Start Time...: - " + hometripstarttime);
        
                hometripendttime = (String) busObject.get("hometripendttime");
                System.out.println("Home Trip End Time.....: - " + hometripendttime);
                
                description = (String) busObject.get("description");	
		System.out.println("Description............: - " + description);
                
                System.out.print("Do you want change this setting (Y/N) :- ");
                Scanner scanner = new Scanner(System.in);
                String save= scanner.nextLine().toUpperCase();
        
                if(save.equals("Y")) {
                    
                    InputSettingValue();
                    
                } 
                
                
	
    }
    
    public int getTripStateTime()
    {
            LocalTime start = LocalTime.parse(this.starttime );
            LocalTime end = LocalTime.parse(this.schooltripstarttime);          
            Boolean t1 = LocalTime.now().isAfter( start );
            Boolean t2 = LocalTime.now().isBefore( end );
            
            if ((t1 && t2)==true) return 1; // Moring time
    
            start = LocalTime.parse(this.schooltripstarttime);
            end = LocalTime.parse(this.schooltripendtime);           
            Boolean t3 = LocalTime.now().isAfter( start );
            Boolean t4 = LocalTime.now().isBefore( end );
            
            if ((t3 && t4)==true) return 1; // Moring time
            
            start = LocalTime.parse(this.schooltripendtime);
            end = LocalTime.parse(this.hometripstarttime);           
            Boolean t5 = LocalTime.now().isAfter( start );
            Boolean t6 = LocalTime.now().isBefore( end ); 
            
            if ((t5 && t6)==true) return 1; // Morning time
           
            start = LocalTime.parse(this.hometripstarttime);
            end = LocalTime.parse(this.hometripendttime);           
            Boolean t7 = LocalTime.now().isAfter( start );
            Boolean t8 = LocalTime.now().isBefore( end );  
            
            if ((t7 && t8)==true) return 2; // Afternoon time
            
            start = LocalTime.parse(this.hometripendttime);
            end = LocalTime.parse(this.endtime);            
            Boolean t9 = LocalTime.now().isAfter( start );
            Boolean t10 = LocalTime.now().isBefore( end );  
            
            if ((t9 && t10)==true) return 2; // Evening Time
            
            
            return 0;
            
           
            
    }    
    
   

    
    
    
}
