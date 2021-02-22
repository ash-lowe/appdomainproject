var https = require('https');
const sql = require("mssql/msnodesqlv8");
const { getUsers } = require('./dboperations');
const UserAccount = require('./useraccount');
var config = {
  driver: 'msnodesqlv8',
  connectionString: 'Driver={SQL Server Native Client XX.0};Server={LAPTOP-OJU1IBVT\SQLEXPRESS};Database={APPDOMAINPROJECT};Trusted_Connection={yes};',
};
sql.connect(config)
.then(function(){
  https://github.com/ash-lowe/appdomainproject.git
  return getUsers
});

/*const conn = new sql.Connection({
    driver: 'msnodesqlv8',
    server: 'LAPTOP-OJU1IBVT\SQLEXPRESS',
    database: 'APPDOMAINPROJECT',
    port : 5140,
    options: {
        trustedConnection: true,
        enableArithAort: true,
        instancename: 'SQLEXPRESS', 
      },
}); 
  module.exports = config;

  conn.connect().then(() => {
  https://github.com/ash-lowe/appdomainproject.git
    
  });
  */