<?php

namespace App\Command;

use App\Entity\Text;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

class ParseTmxCommand extends Command
{
    /** @var EntityManagerInterface */
    private $emi;
    
    public function __construct(EntityManagerInterface $emi, ?string $name = null)
    {
        $this->emi = $emi;
        
        parent::__construct($name);
    }
    
    
    protected function configure()
    {
        $this->setName('parse_tmx');
    }
    
    /**
     * @param ArgvInput $input
     * @param ConsoleOutput $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $folder = __DIR__ .'/../../tmx/';
        $files = array_values(array_diff(scandir($folder), ['.', '..']));

        $output->writeln("Importing TMX files...");
        $imported = 0;

        // wipe current db
        $this->truncateTable();
        
        foreach ($files as $file) {
            $filename = basename($file);
            $pi = pathinfo($file);
            $ext = $pi['extension'];

            if ($ext != 'tmx') {
                continue;
            }

            $file = $folder . $file;

            $output->writeln("");
            $output->writeln("Parsing TMX: {$filename}");

            // grab XML
            $output->writeln('Loading XML...');
            $xml = file_get_contents($file);
            
            // Parse XML
            $output->writeln('Parsing XML...');
            $xml = new \SimpleXMLElement($xml);
    
            // Convert to JSON because XML sucks
            $output->writeln('Converting to JSON...');
            $json = json_encode($xml, JSON_PRETTY_PRINT);
            
            // save
            $output->writeln('Saving JSON...');
            file_put_contents($file . ".json", $json, JSON_PRETTY_PRINT);
    
            // decode into usable object
            $output->writeln('Decoding JSON...');
            $json = json_decode(file_get_contents($file . ".json"));
    
            // start parsing
            $total = count($json->body->tu);
            $output->writeln("Parsing {$total} translations ...");

            $section = $output->section();
            $count = 0;

            foreach ($json->body->tu as $i => $translation) {
                $original = $translation->tuv[0]->seg ?? false;
                $translated = $translation->tuv[1]->seg ?? false;
                $name = $translation->prop[6] ?? "(Unknown Doc)";
                $count++;

                // dunno what to do?
                if (!is_string($original) || !is_string($translated)) {
                    continue;
                }
    
                $section->overwrite("{$count}/{$total} -- Saved: {$original}");
        
                $text = new Text();
                $text->setOriginal($original);
                $text->setTranslated($translated);
                $text->setData($translation);
                $text->setName($name);
                $text->setFilename($filename);
                $this->emi->persist($text);
        
                if ($count % 50 == 0) {
                    $this->emi->flush();
                    $this->emi->clear();
                }
            }
    
            $output->writeln('Saving to database....');
            $this->emi->flush();
    
            $output->writeln("Complete: {$filename}");
            
            // delete .json file
            unlink($file . ".json");
            $imported++;
        }

        $output->writeln("{$imported} imported tmx files.");
    }
    
    private function truncateTable()
    {
        $this->emi->getConnection()->exec('DELETE FROM text');
    }
}
