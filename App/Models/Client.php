<?php
declare(strict_types=1);

namespace App\Models;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="clients")
 */
// TODO Change ident to GUID
class Client {  

    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    public $id;
    /** 
     * @ORM\Column(type="string") 
     */
    public $name;
    /** 
     * @ORM\Column(type="string") 
     */
    public $email;
    /** 
     * @ORM\Column(type="string") 
     */
    public $phone;
}