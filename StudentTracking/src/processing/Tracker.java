/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package processing;

import java.util.LinkedList;
import java.util.Queue;
import studenttracking.Tracking;

/**
 *
 * @author mustafa
 */
public class Tracker implements Runnable{

    private final  Tracking tracking;
    private Tracking Period;
    
    public Tracker(Tracking tracking)
    {
        this.tracking = tracking;
        Period = this.tracking.currentperiod();
        
    }
    
    public static Queue<String> queue = new LinkedList();
    private static volatile boolean running =true;
    public void run() {
        
        
        while(running) {
             
            
             
             
             if (!tracking.IsCurrentPerod(Period)) {
                 
                 Period = this.tracking.currentperiod();
                 //System.out.print(Period.starttime + " " + Period.endtime + " Enter Zero To Exit\r");
                 continue;
             } else {
                    //System.out.print(Period.starttime + " " + Period.endtime );
             }
             
             
             //System.out.println("Hello ");
             if (!queue.isEmpty())
             {
                 String tag =queue.poll();
                 Period.readstudent(tag);
             }
             try {
                 Thread.sleep(100);
                 
             } catch (InterruptedException e) {
                 
                 e.printStackTrace();
             }
        }
    }
    
   public static void shutdown()
   {
       running = false;
   }
   
   public static boolean status()
   {
       return running;
   }
    
    
}
