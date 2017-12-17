    <div class="form-group" >

        <label class="col-form-label" style="font-size: 20px;">School</label>
        <select name="selschool" class="selectpicker" 
                style="height:35px;margin-left:10px;margin-right:10px;">
          <?php

              while($school = mysqli_fetch_assoc($school_set)) {
                echo "<option value=\"{$school["SchoolNo"]}\"";
                if($school["SchoolNo"] == $selectedschool) {
					        echo " selected";
					      }
                echo ">{$school["SchoolName"]}  -  {$school["schooldistrict"]}</option>";
              }
              
          ?>
      </select>


        <input type="submit" name="search" value="Search"
        class="btn btn-primary"/>
        <!--
          <button type="submit" name="search" class="btn btn-primary">Search</button>
        -->

    </div>