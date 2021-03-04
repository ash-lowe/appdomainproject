var https = require('https');
const sql = require("mssql/msnodesqlv8");
const { getUsers } = require('./dboperations');
const UserAccount = require('./useraccount');
var config = {
  driver: 'msnodesqlv8',
  connectionString: 'Driver={SQL Server Native Client 11.0};Server={LAPTOP-OJU1IBVT\SQLEXPRESS};Database={APPDOMAINPROJECT};Trusted_Connection={yes};',
};
sql.connect(config)
.then(function(){
  "https://github.com/ash-lowe/appdomainproject.git"
});
module.exports = config;