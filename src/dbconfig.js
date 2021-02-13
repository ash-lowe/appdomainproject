const sql = require("mssql");
require("msnodesqlv8");
const conn = new sql.Connection({
    driver: 'msnodesqlv8',
    server: '14.0.1000',
    database: 'APPDOMAINPROJECT',
    port : 5140,
    options: {
        trustedConnection: true,
        enableArithAort: true,
        instancename: 'SQLEXPRESS', 
      },
});

  module.exports = config;