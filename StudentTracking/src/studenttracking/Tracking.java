/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package studenttracking;

import settings.Settings;


/**
 *
 * @author mustafa
 */
public abstract class Tracking {
    
    public  String starttime ="00:00:00" ;
    public  String endtime ="23:00:00";
    public int schoolno;
    
    public boolean IsCurrentPerod(Tracking Period)
    {
            return true;
            
    }    
    
    public Tracking currentperiod()
    {
        
       
        return this;
      
        
        
    }
    
    public void readstudent(String studentRFIDTag){};
    
    public int scanningTimeState()
    {
        return 0;
    }
    
    
    public abstract void InputSettingValue();
    public abstract void loadsetting();
    
    
    protected void initialSetting(String filename)
    {
       if (!Settings.IsFileexists(filename))
       {
           InputSettingValue();
       }else {
           
           loadsetting();
       }
    }
    
    protected void alert() {
    
    
    
    }   
    
   
    
}
