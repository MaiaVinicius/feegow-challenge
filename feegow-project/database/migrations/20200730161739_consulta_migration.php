<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ConsultaMigration extends AbstractMigration
{
    public function up() 
    {
        $consulta = $this->table("consulta");

        $consulta->addColumn("specialty_id", "integer");
        $consulta->addColumn("professional_id", "integer");
        $consulta->addColumn("name", "string");
        $consulta->addColumn("cpf", "string");
        $consulta->addColumn("source_id", "integer");
        $consulta->addColumn("birth_date", "datetime");
        $consulta->addTimestamps("date_time");

        $consulta->save();
    }

    public function down() 
    {
        $this->table("consulta")->drop()->save();
    }
}
