import express from 'express';
import bodyParser from 'body-parser';
import  usersRoutes from './routes/user.js';

var express = require('express');
var path = require("path");
var Router = require('./modules/router/router');
var router = new Router(path.join(__dirname,'routes'));

const app = express();
const PORT = 5140;

app.use(bodyParser.json());
app.use(cors());
app.use('/user',usersRoutes);

app.get('/', (req, res) => {
    console.log('[TEST]');
    res.send('hello from homepage.' );
});

app.listen(PORT, () => console.log(`Server running on port: http://localhost:${PORT}`));