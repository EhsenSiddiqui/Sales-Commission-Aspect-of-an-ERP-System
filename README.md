# Sales Commission Aspect of an ERP System
In spring 2021, I took enterprise resource planning as a course at my university. My instructor asked every student of the class to build a web app that should function 
like an aspect of a large and complex ERP system. His instructions were as follows: 


## Objective:
Develop a cross functional workflow based system


## General Guidelines:
<ul>
 
<li>You have to build a web based interface for the workflow part only. <br> </li>
<li>You will manually feed data into setup tables (this step is to reduce your effort. Thank me later) <br> </li>
<li>Your work will be hosted on a web server (purchase $5 dollar per month subscription at Digital Ocean to host entire class’s work) <br> </li>
<li>The reviewers of your work will be your own class fellows and me. <br> </li>
<li>An actor within the workflow system can see his/her action items in the inbox. <br> </li>
<li>For each activity a notification email is sent to relevant actors to initiate action <br> </li>
<li>Use git to maintain versions of your code. Your work should be of such standard that the link of git repository would become part of your CV <br> </li>
<li>Design your data models in such a manner that all stories and their workflows can be integrated together <br> </li>
</ul>

The instructor gave us 6 stories from which each student had to choose one. I chose the fourth story. 

### Story # 4 - Sales Commission
Management allocates sales commission and incentive plans for each quarter. The plan details the commission percentage and incentive amount a salesperson will receive 
for selling products. The plan is approved by the CEO. The system calculates the commission for salespersons and sends it to the head of the sales department. 
The head approves the commission and the payments start appearing at the payment section. The payables manager processes each and every payment and confirmation mail 
is sent to the sales person.


The timeline for this project was as follows: 
<ul>
<li> Week # 0: Choose  the story to work on. Ask questions during or after the first session <br> </li>
<li> Week # 2: Submission of workflow (In BPMN 2.0 compliant format) <br> </li>
<li> Week # 4: a) Storyboard with wireframes of UI. b) Database Model <br> </li>
<li> Week # 6: First demo of workflow. <br> </li>
<li> Week # 8: Final demo of the system along with presentation to be uploaded on youtube <br> </li>
</ul>

<b>Noteworthy functionalities</b> that I implemented in this project were:
<ul>
<li>Complete multi-user login with all situations handled. A user cannot go back to login page — even if they type its URL on the address bar and hit enter — until and unless they have clicked the log out option.<br> </li>

<li>Automatic confirmation email delivery using PHPMailer. <br> </li>

<li>Change in user interface in real time when the user performs any action. <br> </li>
</ul>

I used the following <b>tools</b> for creating this web app: 

<ul>
 <li> PHP for backend </li>
 <li> MySQL for database </li>
 <li> HTML, CSS, and Bootstrap for frontend </li>
</ul> 
