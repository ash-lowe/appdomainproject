# appdomainproject
 
- SWE4713 - Application Domain Semester Project Requirements
# To develop
- Download and install Visual Studio Code from [http://code.visualstudio.com/]
- Open this repo in Visual Studio Code
- After you finish coding, push your changes to the develop branch. Then be sure to open a Pull Request to merge them into the master branch
- Once that is done, the code should update so that the master branch has the new code

# To Run The Website Locally
- Ensure all packages are installed on your platform by running 'npm install'
- You may have to run 'npm install mysql' to have the program work
- Make sure nothing is listening to port 5140 by running 'netstat -ano | findstr :5140' 
- If a number appears next to the 'LISTNENING' run 'taskkill /PID <PID> /F' but replace PID with that number
- There should be an updated example of the useraccount schema in the schema.sql file
- You may need to install this on your Microsoft Sql Management Server to get it to work (but also maybe not)
- To test project run 'npm start' in the terminal