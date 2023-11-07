
<?php
$s = "border:1px solid black;"
?>    
    <div class="container-fluid px-4">
        <table style="text-align:center; border:2px solid;">
        <thead>
          <tr style="border:1px solid black;">
          
            <th scope="col" style="border:1px solid black;text-align:center;"><b>#</b></th>
            <th scope="col" style="border:1px solid black;text-align:center;"><b>First Name</b></th>
            <th scope="col" style="border:1px solid black;text-align:center;"><b>Last Name</b></th>
            <th scope="col" style="border:1px solid black;text-align:center;"><b>Salary</b></th> 
            <th scope="col" style="border:1px solid black;text-align:center;"><b>Address</b></th> 
            <th scope="col" style="border:1px solid black;text-align:center;"><b>Department</b></th>
            <th scope="col" style="border:1px solid black;text-align:center;"><b>City</b></th> 
            <th scope="col" style="border:1px solid black;text-align:center;"><b>Country</b></th>
          
          </tr>
        </thead>
        <tbody>
          @php
            $sum = 0;
          @endphp
          @foreach ($employees as $key => $emp)
          <tr >
            <th scope="row" style="border:1px solid black;text-align:center;">{{ $key+1 }}</th>
            <td style="{{ $s }}text-align:center;">{{ $emp->first_name }}</td>
            <td style="{{ $s }}text-align:center;">{{ $emp->last_name }}</td>
            <td style="{{ $s }} text-align:center;">{{ number_format($emp->salary) }}</td>
            <td style="{{ $s }} text-align:center;">{{ $emp->address }}</td>
            <td style="{{ $s }}text-align:center;">{{ $emp->department->name }}
            <td style="{{ $s }}text-align:center;">{{ $emp->department->city->name }}</td>
            <td style="{{ $s }}text-align:center;">{{ $emp->department->city->country->name }}</td>
          </tr>
          @php
            $sum += $emp->salary;
          @endphp
          @endforeach
         
          
        </tbody>
      </table>
    </div>
    <div style="{{ $s }}">
      <table style="background-color: #ffffff; filter: alpha(opacity=40); opacity: 0.95;border:1px red solid;">
      <tr style="border:1px solid black;text-align:center;">
        
        <td> </td>
        <td><b>the summation of</b> </td>
        <td><b>&nbsp;shown salaries</b></td>
        <td><b>is {{ number_format($sum) }}</b></td>
        <td></td>
        <td></td>
        <td></td>
        <td> </td>
        
      </tr>
      </table>
      </div>