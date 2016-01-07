<?php
namespace Lib;
interface i_Dbase {
	public function connect();
	public function disconnect();
	public function simpleQuery();
	public function query($query);
	public function escape($value);
	public function getLastInsertedId();
	public function getLastError();
	public function getAffectedRows();
}