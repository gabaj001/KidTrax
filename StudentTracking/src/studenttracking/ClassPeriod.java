/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package studenttracking;


import java.io.BufferedReader;
import java.io.IOException;
import java.util.Enumeration;
import java.util.Hashtable;
import java.util.Iterator;
import java.util.logging.Level;
import java.util.logging.Logger;
import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import org.json.simple.parser.JSONParser;
import org.json.simple.parser.ParseException;
import php.PhpClass;
import settings.Settings;

/**
 *
 * @author mustafa
 */
public class ClassPeriod extends Tracking {
    
    private Hashtable<String, Student> studentMap  = new Hashtable<String, Student>();
    
    public  int subjectId  ;
    public  String SubjectName ;
    public  int PeriodNo;
    //public  String starttime ;
    //public  String endtime ;
    public  int SessionNo;
    public String RoomNo;
    
    ClassPeriod(int SessionNo,int subjectId,String SubjectName,int PeriodNo,String starttime,String endtime,String RoomNo)
    {
        this.subjectId = subjectId  ;
        this.SubjectName = SubjectName  ;
        this.PeriodNo = PeriodNo ;
        this.starttime = starttime;
        this.endtime = endtime;
        this.SessionNo = SessionNo;
        this.RoomNo = RoomNo;
        LoadClassPeriod();
    }
    
    public String toString()
    {
        return subjectId + " " + SubjectName + " " + PeriodNo+ " " + starttime+ " "  + endtime;
    }
    
    public   void LoadClassPeriod()
    {
                     
           String json = "{\"SessionNo\":\"" + this.SessionNo + "\"}";
      
           String Url = Settings.getUrl() + "studentclass.php?studentclass="+json;
            
          

           JSONParser jsonParser = new JSONParser();
           
           BufferedReader rd = PhpClass.LoadData(Url);
           try {
                Object obj = jsonParser.parse(rd);
                JSONArray ClassPeriodInfo = (JSONArray) obj;
                
            //System.out.println(ClassPeriodInfo);
            
            rd.close();
            
            ClassPeriodInfo.forEach( info -> parsePeriodInfo( (JSONObject) info ) );
                
           } catch (IOException ex) {
               Logger.getLogger(SchoolClass.class.getName()).log(Level.SEVERE, null, ex);
           } catch (ParseException ex) {
               Logger.getLogger(SchoolClass.class.getName()).log(Level.SEVERE, null, ex);
           }
           
        }
        
        private   void parsePeriodInfo(JSONObject PeriodInfo) 
	{
		
		JSONObject info = (JSONObject) PeriodInfo;
		
		int schoolno = Integer.parseInt((String) info.get("schoolno"));	
		//System.out.println(schoolno);
                
		int StudentID = Integer.parseInt((String) info.get("studentID"));	
		//System.out.println(StudentID);
		
		
		String StudentName = (String) info.get("studentName");	
		//System.out.println(StudentName);
                
                String studentRFIDTag = (String) info.get("studentRFIDTag");	
		//System.out.println(studentRFIDTag);
                
                
                int studentsessionNo = Integer.parseInt((String) info.get("studentsessionNo"));	
		//System.out.println("studentsessionNo " + studentsessionNo);
                
                
                int SessionNo = Integer.parseInt((String) info.get("SessionNo"));	
		//System.out.println("SessionNo " + SessionNo);
                
                int PeriodNO = Integer.parseInt((String) info.get("PeriodNO"));	
		//System.out.println("Period " + PeriodNO);               
                
		
                //System.out.println("----------------------------------");
		
		studentMap.put(studentRFIDTag, new Student(StudentID,schoolno,studentsessionNo,RoomNo));
                
        }
        
        public void ListPeriods()
        {
             for (String key : studentMap.keySet()) {
             System.out.println("------------------------------------------------");
             System.out.println("key: " + key + " value: " + studentMap.get(key).StudentID);
            }
        }
        
        
        public void sentStudentcurrentInfo(String studentrifdtag,String RoomNo,int Schoolno) 
        {

                JSONObject Jsonobj = new JSONObject();
                
                String placename = "In Classroom number " + RoomNo;

                Jsonobj.put("placename", placename.replace(" ", "%20"));
                Jsonobj.put("activitytime", Settings.getCurrentTime());
                Jsonobj.put("activitydate", Settings.getCurrentDate());
                Jsonobj.put("timeState", 0);
                Jsonobj.put("studentrifdtag", studentrifdtag);
                Jsonobj.put("schoolno", Schoolno);
                
                
               
                String json = Jsonobj.toJSONString();
                
                //System.out.println(Settings.getUrl() + "StudentActivity.php?studentactivity="+json);

                try {
                    PhpClass.insertRow(Settings.getUrl() + "StudentActivity.php?studentactivity="+json);
                    //System.out.println(Settings.getUrl() + "StudentActivity.php?studentActivity="+json);
                    System.out.println("Student Info has sent");
                } catch (IOException ex) {
                    Logger.getLogger(StudentActivity.class.getName()).log(Level.SEVERE, null, ex);
                }
                
        }

        public void readstudent(String studentRFIDTag)
        {
           
                    
            //ListPeriods();
             //System.out.println("Visit");
            Student student = studentMap.get(studentRFIDTag);
            if (student!=null) {
                //if (student.)
                student.sentStudentInfoTracking();
                //System.out.println("Session ==>" + SessionNo);
                //System.out.println(studentRFIDTag);
               //System.out.println("Visit 1");
            } else {
                    //alert();
                    Enumeration   tag = studentMap.keys();
                    if(tag.hasMoreElements()) {
                        String key = (String) tag.nextElement();
                       student = studentMap.get(key);
                       //System.out.println("======> " + student.schoolno);
                       sentStudentcurrentInfo(studentRFIDTag,student.RoomNo,student.schoolno);
                       
                    }
                    
                    //System.out.println("Visit 2");
            }
        }

    @Override
    public void InputSettingValue() { }

    @Override
    public void loadsetting() {
        
    }
               
        private class Student {

            public int StudentID;
            public int schoolno;
            public int studentsessionNo;
            public String RoomNo;

            Student(int StudentID,int schoolno,int studentsessionNo,String RoomNo)
            {
                this.StudentID = StudentID;
                this.schoolno = schoolno;
                this.studentsessionNo = studentsessionNo;
                this.RoomNo = RoomNo;
            }




            public void sentStudentInfoTracking() 
            {

                JSONObject Jsonobj = new JSONObject();
                
                
                Jsonobj.put("time_attendance", Settings.getCurrentTime());
                Jsonobj.put("date_ttendance", Settings.getCurrentDate());
                Jsonobj.put("studentid", StudentID);
                Jsonobj.put("schoolno", schoolno);
                Jsonobj.put("studentsessionNo", studentsessionNo);

                String json = Jsonobj.toJSONString();

                try {
                    PhpClass.insertRow(Settings.getUrl() + "insertstudentattendance.php?studentattendance="+json);
                } catch (IOException ex) {
                    Logger.getLogger(ClassPeriod.class.getName()).log(Level.SEVERE, null, ex);
                }
                System.out.println("Student Info has sent");
            }

        }

    
}

