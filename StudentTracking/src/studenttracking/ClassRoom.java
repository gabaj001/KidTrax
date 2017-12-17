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
import java.util.Iterator;
import java.util.LinkedList;
import java.util.Queue;
import java.util.Scanner;
import java.util.logging.Level;
import java.util.logging.Logger;
import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import org.json.simple.parser.JSONParser;
import org.json.simple.parser.ParseException;
import php.PhpClass;
import settings.ReadJSON;
import settings.Settings;
import settings.WriteJSON;


/**
 *
 * @author mustafa
 */
public class ClassRoom extends Tracking {
    
    private SchoolClass schoolclass;
    
    
    Queue<ClassPeriod> PeriodQueue = new LinkedList();

    public  int SessionNo;
    public  String RoomNo;
    public  int Term_ser;
    public  int Termno;
    public  String startdate;
    public  String enddate ;
    public  int TeacherId ;
    public  String Teachername ;
    private String description;
    
    ClassRoom()
    {
        Settings.settingfilename = "clssetting.json";
        super.initialSetting(Settings.settingfilename);
        
        //SchoolClass school = SchoolClass.getinstance();
        //school.setschoolno(schoolno);
        //school.LoadSchoolInfo();
       
        
    }
    
    
    public   void LoadClassRoomInfo()
    {
                     
           
           JSONObject Jsonobj = new JSONObject();

            Jsonobj.put("schoolno", schoolno);
            Jsonobj.put("roomno", RoomNo);
            String json = Jsonobj.toJSONString();

      
           String Url = Settings.getUrl() + "ClassRoom.php?classroom="+json;
           //System.out.println(Url);
           JSONParser jsonParser = new JSONParser();
           
           BufferedReader rd = PhpClass.LoadData(Url);
           try {
                Object obj = jsonParser.parse(rd);
                JSONArray ClassRoomInfo = (JSONArray) obj;
                if (ClassRoomInfo.isEmpty())
                    System.out.println("There Is No Data In Database "
                            + "Compatible "
                            + "With Traking Systsem 1");
            
            rd.close();
            
            ClassRoomInfo.forEach( info -> parseClassRoomInfo( (JSONObject) info ) );
                
           } catch (IOException ex) {
               Logger.getLogger(SchoolClass.class.getName()).log(Level.SEVERE, null, ex);
           } catch (ParseException ex) {
               Logger.getLogger(SchoolClass.class.getName()).log(Level.SEVERE, null, ex);
           }
           
        }
       
       	private   void parseClassRoomInfo(JSONObject schoolInfo) 
	{
		
		JSONObject schoolInfoObject = (JSONObject) schoolInfo;
		
		
		SessionNo = Integer.parseInt((String) schoolInfoObject.get("SessionNo"));	
		//System.out.println(SessionNo);
		
		
		RoomNo = (String) schoolInfoObject.get("RoomNo");	
		//System.out.println("=======> " + RoomNo);
		
		
		Term_ser = Integer.parseInt((String) schoolInfoObject.get("Term_ser"));	
		//System.out.println(Term_ser);
                
                		
		Termno = Integer.parseInt((String) schoolInfoObject.get("Termno"));	
		//System.out.println(Termno);
                
                startdate = (String) schoolInfoObject.get("startdate");	
		//System.out.println(startdate); 
                
                enddate = (String) schoolInfoObject.get("enddate");	
		//System.out.println(enddate); 
                
                TeacherId = Integer.parseInt((String) schoolInfoObject.get("TeacherId"));	
		//System.out.println(TeacherId); 
                
                Teachername = (String) schoolInfoObject.get("Teachername");	
                //System.out.println(Teachername);
                
                
                int subjectId = Integer.parseInt((String) schoolInfoObject.get("subjectId"));	
		//System.out.println(subjectId); 
                
                String SubjectName = (String) schoolInfoObject.get("SubjectName");	
		//System.out.println(SubjectName); 
                
                int PeriodNo = Integer.parseInt((String) schoolInfoObject.get("PeriodNo"));	
		//System.out.println(PeriodNo); 
                
                String starttime = (String) schoolInfoObject.get("starttime");	
		//System.out.println(starttime); 
                
                String endtime = (String) schoolInfoObject.get("endtime");	
		//System.out.println(endtime); 
                //System.out.println("********************************************");
                PeriodQueue.add(new ClassPeriod(SessionNo,subjectId,SubjectName,PeriodNo,starttime,endtime,RoomNo));
                
	}
        
    @Override
    public boolean IsCurrentPerod(Tracking classperiod)
    {
            LocalTime start = LocalTime.parse( classperiod.starttime );
            LocalTime end = LocalTime.parse( classperiod.endtime );
            
            Boolean isLate = LocalTime.now().isAfter( start );
            Boolean isLate1 = LocalTime.now().isBefore(end);
           
            return ((isLate && isLate1));
            
           
            
    }     
          
    public ClassPeriod currentperiod()
    {
        
        if (PeriodQueue.isEmpty()) 
            return null;
        
        ClassPeriod classperiod = PeriodQueue.poll();
        
        PeriodQueue.add(classperiod);
        
        
        
        return classperiod;
      
        
        
    }
    
    

    @Override
    public void InputSettingValue() {
        
        Hashtable<String,String> classroomSetting=new Hashtable<String,String>();
        
        Scanner scanner = new Scanner(System.in);
        System.out.println("\n Enter The Following Setting Information");
        
        System.out.print("School Number.....: - ");
        schoolno = Integer.parseInt(scanner.nextLine());
        classroomSetting.put("schoolno", "" + schoolno);
        
        System.out.print("Class Room Number : - ");
        RoomNo = scanner.nextLine();
        classroomSetting.put("roomno", RoomNo);
        
        System.out.print("Description.......: - ");
        description = scanner.nextLine();
        classroomSetting.put("description", description);
        
        
        System.out.print("Do You Want Save This Information (Y/N) :- ");
        
        String save= scanner.nextLine().toUpperCase();
        
        if(save.equals("Y")) {
            
            WriteJSON.writejson("ClassRoomDetails", classroomSetting);
            
            System.out.println("The Setting Updated");
            
        }
        
        classroomSetting.clear();
       
         
        
    }

    @Override
    public void loadsetting() {
        
              JSONArray list = ReadJSON.readjson(Settings.settingfilename);
    
              list.forEach( cls -> getClassRoomDetails( (JSONObject) cls ) );
    
    }
    
    
    private  void getClassRoomDetails(JSONObject classroom) 
    {
            
		System.out.println("\nTracking System Information ");
		JSONObject classroomObject = (JSONObject) classroom.get("ClassRoomDetails");
	        schoolno = Integer.parseInt((String) classroomObject.get("schoolno"));	
		System.out.println("School Number.....: - " + schoolno);
                
                RoomNo = (String) classroomObject.get("roomno");	
		System.out.println("Class Room Number : - " + RoomNo);
                
                description = (String) classroomObject.get("description");	
		System.out.println("Description.......: - " + description);
                
                System.out.print("Do you want change this setting (Y/N) :- ");
                Scanner scanner = new Scanner(System.in);
                String save= scanner.nextLine().toUpperCase();
        
                if(save.equals("Y")) {
                    
                    InputSettingValue();
                    
                } 
                
	
    }
}

  
