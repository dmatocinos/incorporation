<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'AuthorizedController' => $baseDir . '/app/controllers/AuthorizedController.php',
    'BaseController' => $baseDir . '/app/controllers/BaseController.php',
    'Business' => $baseDir . '/app/models/Business.php',
    'BusinessesController' => $baseDir . '/app/controllers/BusinessesController.php',
    'BusinessesTableSeeder' => $baseDir . '/app/database/seeds/BusinessesTableSeeder.php',
    'CapitalGainsTax' => $baseDir . '/app/models/CapitalGainsTax.php',
    'Capitalisation' => $baseDir . '/app/models/Capitalisation.php',
    'Client' => $baseDir . '/app/models/Client.php',
    'ClientTaxTableInfo' => $baseDir . '/app/models/ClientTaxTableInfo.php',
    'Clients' => $baseDir . '/app/database/migrations/2013_12_30_025026_clients.php',
    'CorporationTax' => $baseDir . '/app/models/CorporationTax.php',
    'CreateBusinessesTable' => $baseDir . '/app/database/migrations/2013_12_28_072926_create_businesses_table.php',
    'CreateOptionsTable' => $baseDir . '/app/database/migrations/2013_12_28_092219_create_options_table.php',
    'CreatePartnersTable' => $baseDir . '/app/database/migrations/2013_12_28_073423_create_partners_table.php',
    'DataEntryController' => $baseDir . '/app/controllers/DataEntryController.php',
    'DatabaseSeeder' => $baseDir . '/app/database/seeds/DatabaseSeeder.php',
    'Datamatrix' => $vendorDir . '/tecnick.com/tcpdf/include/barcodes/datamatrix.php',
    'DividendsInLimitedCoController' => $baseDir . '/app/controllers/DividendsInLimitedCoController.php',
    'DividendsInLimitedCoService' => $baseDir . '/app/services/DividendsInLimitedCoService.php',
    'ExcelEngine' => $baseDir . '/app/services/ExcelEngine.php',
    'HomeController' => $baseDir . '/app/controllers/HomeController.php',
    'IlluminateQueueClosure' => $vendorDir . '/laravel/framework/src/Illuminate/Queue/IlluminateQueueClosure.php',
    'IncomeTaxData' => $baseDir . '/app/models/IncomeTaxData.php',
    'IncorporationEngine' => $baseDir . '/app/services/IncorporationEngine.php',
    'IncorporationReport' => $baseDir . '/app/services/IncorporationReport.php',
    'NationalInsurance' => $baseDir . '/app/models/NationalInsurance.php',
    'Option' => $baseDir . '/app/models/Option.php',
    'OptionsController' => $baseDir . '/app/controllers/OptionsController.php',
    'OptionsTableSeeder' => $baseDir . '/app/database/seeds/OptionsTableSeeder.php',
    'OverallTax' => $baseDir . '/app/models/OverallTax.php',
    'PDF417' => $vendorDir . '/tecnick.com/tcpdf/include/barcodes/pdf417.php',
    'Partner' => $baseDir . '/app/models/Partner.php',
    'PartnersController' => $baseDir . '/app/controllers/PartnersController.php',
    'PartnersTableSeeder' => $baseDir . '/app/database/seeds/PartnersTableSeeder.php',
    'PartnershipTaxAndNationalInsuranceController' => $baseDir . '/app/controllers/PartnershipTaxAndNationalInsuranceController.php',
    'PartnershipTaxAndNationalInsuranceService' => $baseDir . '/app/services/PartnershipTaxAndNationalInsuranceService.php',
    'QRcode' => $vendorDir . '/tecnick.com/tcpdf/include/barcodes/qrcode.php',
    'RemindersController' => $baseDir . '/app/controllers/RemindersController.php',
    'ReportController' => $baseDir . '/app/controllers/ReportController.php',
    'ResultsController' => $baseDir . '/app/controllers/ResultsController.php',
    'Route' => $baseDir . '/app/models/Routes.php',
    'SalaryInLimitedCoController' => $baseDir . '/app/controllers/SalaryInLimitedCoController.php',
    'SalaryInLimitedCoService' => $baseDir . '/app/services/SalaryInLimitedCoService.php',
    'SessionHandlerInterface' => $vendorDir . '/symfony/http-foundation/Symfony/Component/HttpFoundation/Resources/stubs/SessionHandlerInterface.php',
    'SummaryComparisonService' => $baseDir . '/app/services/SummaryComparisonService.php',
    'SummaryController' => $baseDir . '/app/controllers/SummaryController.php',
    'SummaryGraphService' => $baseDir . '/app/services/SummaryGraphService.php',
    'SummaryTotalSavingsService' => $baseDir . '/app/services/SummaryTotalSavingsService.php',
    'TCPDF' => $vendorDir . '/tecnick.com/tcpdf/tcpdf.php',
    'TCPDF2DBarcode' => $vendorDir . '/tecnick.com/tcpdf/tcpdf_barcodes_2d.php',
    'TCPDFBarcode' => $vendorDir . '/tecnick.com/tcpdf/tcpdf_barcodes_1d.php',
    'TCPDF_COLORS' => $vendorDir . '/tecnick.com/tcpdf/include/tcpdf_colors.php',
    'TCPDF_FILTERS' => $vendorDir . '/tecnick.com/tcpdf/include/tcpdf_filters.php',
    'TCPDF_FONTS' => $vendorDir . '/tecnick.com/tcpdf/include/tcpdf_fonts.php',
    'TCPDF_FONT_DATA' => $vendorDir . '/tecnick.com/tcpdf/include/tcpdf_font_data.php',
    'TCPDF_IMAGES' => $vendorDir . '/tecnick.com/tcpdf/include/tcpdf_images.php',
    'TCPDF_IMPORT' => $vendorDir . '/tecnick.com/tcpdf/tcpdf_import.php',
    'TCPDF_PARSER' => $vendorDir . '/tecnick.com/tcpdf/tcpdf_parser.php',
    'TCPDF_STATIC' => $vendorDir . '/tecnick.com/tcpdf/include/tcpdf_static.php',
    'TestCase' => $baseDir . '/app/tests/TestCase.php',
    'User' => $baseDir . '/app/models/User.php',
    'UserController' => $baseDir . '/app/controllers/UserController.php',
    'Way\\Generators\\Generators\\ControllerGenerator' => $vendorDir . '/way/generators/src/Way/Generators/Generators/ControllerGenerator.php',
    'Way\\Generators\\Generators\\FormDumperGenerator' => $vendorDir . '/way/generators/src/Way/Generators/Generators/FormDumperGenerator.php',
    'Way\\Generators\\Generators\\Generator' => $vendorDir . '/way/generators/src/Way/Generators/Generators/Generator.php',
    'Way\\Generators\\Generators\\MigrationGenerator' => $vendorDir . '/way/generators/src/Way/Generators/Generators/MigrationGenerator.php',
    'Way\\Generators\\Generators\\ModelGenerator' => $vendorDir . '/way/generators/src/Way/Generators/Generators/ModelGenerator.php',
    'Way\\Generators\\Generators\\RequestedCacheNotFound' => $vendorDir . '/way/generators/src/Way/Generators/Generators/Generator.php',
    'Way\\Generators\\Generators\\ResourceGenerator' => $vendorDir . '/way/generators/src/Way/Generators/Generators/ResourceGenerator.php',
    'Way\\Generators\\Generators\\ScaffoldGenerator' => $vendorDir . '/way/generators/src/Way/Generators/Generators/ScaffoldGenerator.php',
    'Way\\Generators\\Generators\\SeedGenerator' => $vendorDir . '/way/generators/src/Way/Generators/Generators/SeedGenerator.php',
    'Way\\Generators\\Generators\\TestGenerator' => $vendorDir . '/way/generators/src/Way/Generators/Generators/TestGenerator.php',
    'Way\\Generators\\Generators\\ViewGenerator' => $vendorDir . '/way/generators/src/Way/Generators/Generators/ViewGenerator.php',
);
