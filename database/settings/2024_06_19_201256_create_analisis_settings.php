<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('analisis.defaultDataSet', 'I need you to analyze the bus transportation system data, including user, transactions, routes, stops, complaints, buses, and schedules. Here are the data: [dataset] Based on the data, please analyze the usage patterns and trends of public transportation users: Identify the usage patterns of public transportation based on user demographics, such as gender and account type. Analyze the frequency of service usage by user category (students vs. general users) for more targeted service improvements.');
    }
};
