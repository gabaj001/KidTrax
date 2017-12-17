/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package settings;

import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import org.json.simple.parser.JSONParser;
import org.json.simple.parser.ParseException;

/**
 *
 * @author mustafa
 */
public class ReadJSON {
    
    	@SuppressWarnings("unchecked")
	public static JSONArray readjson(String filename)
	{
            //JSON parser object to parse read file
            JSONParser jsonParser = new JSONParser();

            try (FileReader reader = new FileReader(filename))
            {
                    //Read JSON file
                    Object obj = jsonParser.parse(reader);

                    JSONArray list = (JSONArray) obj;
                    //System.out.println(list);
                    return list;
 
            
            

            } catch (FileNotFoundException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            } catch (ParseException | NullPointerException e) {
                e.printStackTrace();
            } catch (Exception e) {
                e.printStackTrace();
            }
            
            return null;
            
	}

	private static void parseGateObject(JSONObject Gate) 
	{
            
		//Get employee object within list
		JSONObject GateObject = (JSONObject) Gate.get("GateDetails");
                
                //System.out.println(GateObject.size());
                
	        String schoolno = (String) GateObject.get("schoolno");	
		System.out.println(schoolno);
                
                String gatedescription = (String) GateObject.get("gatedescription");	
		System.out.println(gatedescription);
                
		//Get employee first name
		String arrivingstarttime = (String) GateObject.get("arrivingstarttime");	
		System.out.println(arrivingstarttime);
		
		//Get employee last name
		String arrivingendtime = (String) GateObject.get("arrivingendtime");	
		System.out.println(arrivingendtime);
		
		//Get employee website name
		String departurestarttime = (String) GateObject.get("departurestarttime");	
		System.out.println(departurestarttime);
                
                String departureendtime = (String) GateObject.get("departureendtime");	
		System.out.println(departureendtime);
                
	}
        
        
       
                
        

    
}
