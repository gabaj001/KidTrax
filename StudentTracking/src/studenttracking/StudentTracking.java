/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package studenttracking;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.util.Scanner;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.util.concurrent.TimeUnit;
import java.util.logging.Level;
import java.util.logging.Logger;
import processing.GPS;
import processing.Tracker;



/**
 *
 * @author mustafa
 */
public class StudentTracking {

    public static String rfid(String line)
    {
        if(line.contains("UID"))
        {
            line = line.replace(" ", "");
            line = line.substring(13);
            return line;
        }
        
        return null;
    }
    
    public static String ReadTagfromRifd() throws IOException, InterruptedException
    {
        String tag = "";
        final Process p = Runtime.getRuntime().exec("/usr/bin/nfc-poll");
        BufferedReader input = new BufferedReader(new InputStreamReader(p.getInputStream()));
        String line = null; 
        try {
                while ((line = input.readLine()) != null) {

                    tag = rfid(line);
                    if (tag!=null) {
                        System.out.println(tag);
                        break;
                    }
                }
                    
            } catch (IOException e) {
                        e.printStackTrace();
            }
        //p.waitFor();
        
        return tag;
        
    }
    public static void ActivityTracking() throws IOException, InterruptedException 
    {
            
            StudentActivity  sc = new StudentActivity ();
            sc.initialSetting();
            String Tag = "";
            for(;;) {
                System.out.print("Scan your card "); 
                Tag = ReadTagfromRifd();
                if (Tag!=null)sc.readstudent(Tag);
   
            }
        
    }
    
    
    public static void classTracking() throws IOException, InterruptedException
    {
        
        ClassRoom clsrm  = new ClassRoom();
        clsrm.LoadClassRoomInfo();
        
        String Tag = "";
        ExecutorService executor = Executors.newFixedThreadPool(1);
         
       executor.submit(new Tracker(clsrm));
       executor.shutdown();
       
       //Scanner scanner = new Scanner(System.in);
       
       System.out.println("System ready to read tags");
       for(;;) {
            
            Tag = ReadTagfromRifd();
            if (Tag!=null) Tracker.queue.add(Tag);
       }
        
    }
    
    public static void GateTracking() throws IOException, InterruptedException
    {
       GateTracking gateTracking = new GateTracking();
      
       
       ExecutorService executor = Executors.newFixedThreadPool(1);
         
       executor.submit(new Tracker(gateTracking));
       executor.shutdown();
       
       String Tag = "";
       System.out.println("System ready to read tags");
       
       for(;;) {
           
            Tag = ReadTagfromRifd();
            if (Tag!=null) Tracker.queue.add(Tag);
            
       }
       
    }
    
    public static void Bus_Tracking() throws IOException, InterruptedException
    {
        BusTracking bstk = new BusTracking();
        //GPS gps = new GPS(bstk.busno,bstk.schoolno);
        GPS gps = new GPS(bstk); 
        
        ExecutorService executor = Executors.newFixedThreadPool(2);
        
        
        executor.submit(new Tracker(bstk));
        executor.submit(gps);
        
        executor.shutdown();
        
        
        String Tag = "";
        System.out.println("System ready to read tags");
        for(;;) {
            //System.out.println(gps.lat + "," + gps.lon);
            Tag = ReadTagfromRifd();
            if (Tag!=null) Tracker.queue.add(Tag);
            
        }
    
    }
    
    public static void RunTrackings() throws IOException, InterruptedException
    {
       for(;;) 
       {
            System.out.println("1- Class Room Tracking");
            System.out.println("2- Student Activties Tracking ");
            System.out.println("3- Entrance Tracking ");
            System.out.println("4- Bus Tracking");
            System.out.println("5- Exit");
            System.out.print("Select Number (1-5) ");
            Scanner scnr = new Scanner(System.in);
            String input = scnr.nextLine();
            
            if (input.equals("5")) {
                
                break;
                
            }
            switch(input) {
                case "1" : classTracking(); break;
                case "2" : ActivityTracking(); 
                           break;
                case "3" : GateTracking(); break;
                case "4" : Bus_Tracking(); break;
                
            }
            
            System.out.println();
       }
       
       System.out.println("Program Shutdown");
       
    }
    public static void main(String[] args) throws IOException, InterruptedException {
      

        RunTrackings();
      
      
    }
}
