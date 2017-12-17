/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package studenttracking;

import java.io.BufferedReader;
import java.io.IOException;
import java.util.logging.Level;
import java.util.logging.Logger;
import settings.Settings;
import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import org.json.simple.parser.JSONParser;
import org.json.simple.parser.ParseException;
import php.PhpClass;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author mustafa
 */
public class SchoolClass {
       
       private  static SchoolClass schoolclass;
       private  int schoolno;
       private  int SchoolYearNo;
       private  String SchoolYear;
       private  int Term_ser;
       private  int TermNo;
       
       private SchoolClass(){}
       
       public static SchoolClass getinstance()
       {
           if (schoolclass==null)
           {
               schoolclass =  new SchoolClass();
           }
           
           return schoolclass;
       }
       
       public void setschoolno(int schoolno)
       {
           this.schoolno = schoolno;
       }
    
       public  void LoadSchoolInfo()
       {
           
           
           String json = "{\"schoolno\":\"" + this.schoolno + "\"}";

           // send as http get request
           String Url = Settings.getUrl() + "schoolinfo.php?school="+json;
           
          

           JSONParser jsonParser = new JSONParser();
           
           BufferedReader rd = PhpClass.LoadData(Url);
           try {
                Object obj = jsonParser.parse(rd);
                JSONArray schoolInfoList = (JSONArray) obj;
                
            //System.out.println(schoolInfoList);
            
            rd.close();
            
            schoolInfoList.forEach( info -> parseSchoolInfo( (JSONObject) info ) );
                
           } catch (IOException ex) {
               Logger.getLogger(SchoolClass.class.getName()).log(Level.SEVERE, null, ex);
           } catch (ParseException ex) {
               Logger.getLogger(SchoolClass.class.getName()).log(Level.SEVERE, null, ex);
           }
           
        }
       
       	private  void parseSchoolInfo(JSONObject schoolInfo) 
	{
		
		JSONObject schoolInfoObject = (JSONObject) schoolInfo;
		
		
		schoolno = Integer.parseInt((String) schoolInfoObject.get("schoolno"));	
		//System.out.println(schoolno);
		
		
		SchoolYearNo = Integer.parseInt((String) schoolInfoObject.get("SchoolYearNo"));	
		//System.out.println(SchoolYearNo);
		
		
		SchoolYear = (String) schoolInfoObject.get("SchoolYear");	
		//System.out.println(SchoolYear);
                
                		
		Term_ser = Integer.parseInt((String) schoolInfoObject.get("Term_ser"));	
		//System.out.println(Term_ser);
                
                int TermNo = Integer.parseInt((String) schoolInfoObject.get("TermNo"));	
		//System.out.println(TermNo); 
	}

       public int getschoolno()
       {
           return schoolno;
       }
       public  int getCurrentyear_series()
       {
           return SchoolYearNo;
       }
       
       public  String getCurrentyear()
       {
           return SchoolYear;
       }
       
       public  int getCurrentTerm_ser()
       {
           return Term_ser;
       }
       
       public  int getCurrentTerm()
       {
           return TermNo;
       }
       
       
       
}
