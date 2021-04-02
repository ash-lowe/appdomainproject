class UserAccount{
    constructor(FNAME, LNAME, EMAIL, B_MONTH, B_DAY, B_YEAR, USERNAME, PASSWORD, APPROVALDATE, QUESTION1,
        ANSWER1, QUESTION2, ANSWER2, QUESTION3, ANSWER3,USERPOSITION, PASSWORDEXPIRE, ACCOUNTACTIVE, STARTSUSPEND, ENDSUSPEND){
            this.FNAME = Fname;
            this.LNAME = Lname;
            this.EMAIL = Email;
            this.B_MONTH = B_Month;
            this.B_DAY = B_Day;
            this.B_YEAR = B_Year;
            this.USERNAME = Username;
            this.PASSWORD = Password;
            this.APPROVALDATE = Approvaldate;
            this.QUESTION1 = Question1;
            this.ANSWER1 = Answer1;
            this.QUESTION2 = Question2;
            this.ANSWER2 = Answer2;
            this.QUESTION3 = Question3;
            this.ANSWER3 = Answer3;
            this.USERPOSITION = userPosition;
            this.PASSWORDEXPIRE = passwordExpire;
            this.ACCOUNTACTIVE = accountActive;
            this.STARTSUSPEND = startSuspend; 
            this.ENDSUSPEND = endSuspend;
        }
}
module.exports = UserAccount;