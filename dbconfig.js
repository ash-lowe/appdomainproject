var https = require('https');
const mysql = require("mysql");
const { getUsers } = require('./dboperations');
const UserAccount = require('./useraccount');
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'n7:G@ceK{JU^D/{',
  database: 'applicationdomain'
});
connection.connect((err) => {
  if(err){
    console.log('Error connecting to Db');
    return;
  }
  console.log('Connection established');
});

connection.end((err) => {
});
module.exports = connection;