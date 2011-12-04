<?php
class Benchmark_1 extends Controller{

	function index()
	{
		$count = 2000;
		$this->benchmark->mark('dog');
		$c1 = 0;
		for ($i = 0; $i < $count; $i++) {
			$c1 = $this->_add($c1); 
		}
		$this->benchmark->mark('cat');
		//Duffs'Device
		$duffs_count = floor($count / 8);	//8で割る
		$duffs_div = $count % 8;		//あまりも求める
		$c2 = 0;
		do{
			switch($duffs_div){
			case 0: $c2 = $this->_add($c2);
			case 7: $c2 = $this->_add($c2);
			case 6: $c2 = $this->_add($c2);
			case 5: $c2 = $this->_add($c2);
			case 4: $c2 = $this->_add($c2);
			case 3: $c2 = $this->_add($c2);
			case 2: $c2 = $this->_add($c2);
			case 1: $c2 = $this->_add($c2);
			}
			$duffs_div = 0;
		}while(--$duffs_count);
		$this->benchmark->mark('monky');
		$c3 = 0;
		for ($i = $count; $i--;) {
			$c3 = $this->_add($c3);
		}
		$this->benchmark->mark('bird');

		$correct_duffs_div = $count%8;
		$c4 = 0;
		while($correct_duffs_div){
			$c4 = $this->_add($c4);
			$correct_duffs_div--;
		}
		$correct_duffs_count = floor($count/8);
		while($correct_duffs_count){
			$c4 = $this->_add($c4);
			$c4 = $this->_add($c4);
			$c4 = $this->_add($c4);
			$c4 = $this->_add($c4);
			$c4 = $this->_add($c4);
			$c4 = $this->_add($c4);
			$c4 = $this->_add($c4);
			$c4 = $this->_add($c4);
			$correct_duffs_count--;
		}
		$this->benchmark->mark('pig');
		echo 'count:'.$c1.' '.$this->benchmark->elapsed_time('dog','cat').'<br/>';
		echo 'count:'.$c2.' '.$this->benchmark->elapsed_time('cat','monky').'<br/>';
		echo 'count:'.$c3.' '.$this->benchmark->elapsed_time('monky','bird').'<br/>';
		echo 'count:'.$c4.' '.$this->benchmark->elapsed_time('bird','pig').'<br/>';
		echo $this->benchmark->elapsed_time('dog','pig').'<br/>';
	}
	function _add($i){
		$i = $i + 1;
		return $i;
	}

}
?>
