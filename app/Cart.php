<?php 

namespace CodeCommerce;

class Cart 
{	

	// add

	// remove

	// all

	// getTotal

	private $items;

	public function __construct()
	{
		$this->items = [];
	}

	public function add($id, $name, $price)
	{
		// id -> qtd, price, name
		$this->items += [
			$id => [
				// se tiver qtd eu somo ela, se não tiver a qtd vai ser 1
				'qtd' 	=> isset($this->items[$id]['qtd']) ? $this->items[$id]['qtd']++:1,
				'price' => $price,
				'name' 	=> $name,
			]
		];

		return $this->items;
	}

	public function removeItem($id)
	{
		$this->items[$id]['qtd']--;

		return $this->items;
	}

	public function remove($id)
	{
		unset($this->items[$id]);
	}

	public function all()
	{
		return $this->items;
	}

	public function getQtd($id)
	{
		$qtd = $this->items[$id]['qtd'];

		return $qtd;
	}

	public function getTotal()
	{
		$total = 0;
		foreach ($this->items as $items) {
			$total += $items['qtd'] * $items['price'];
		}

		return $total;
	}

	public function clear()
	{
		$this->items = [];
	}

}