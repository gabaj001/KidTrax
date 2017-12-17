/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package settings;

import java.io.FileWriter;
import java.io.IOException;
import java.util.Hashtable;
import java.util.Map;

import org.json.simple.JSONArray;
import org.json.simple.JSONObject;

/**
 *
 * @author mustafa
 */
public class WriteJSON {
    
    @SuppressWarnings("unchecked")
    public static void writejson(String Obj,Hashtable<String,String> gateSetting )
    {
        //System.out.println(gtst.getKey() + " " + gtst.getValue());
        
        JSONObject Details = new JSONObject();
        for(Map.Entry gtst:gateSetting.entrySet()){  
                
            Details.put(gtst.getKey(), gtst.getValue());
        } 
        
        JSONObject object = new JSONObject(); 
    	object.put(Obj, Details);
        
        JSONArray list = new JSONArray();
    	list.add(object);

        //Write JSON file
    	try (FileWriter file = new FileWriter(Settings.settingfilename)) {

            file.write(list.toJSONString());
            file.flush();

        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    
   
}

