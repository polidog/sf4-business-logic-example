<?php

namespace App\Command;


use Acme\Account\UseCase\CreateAccount;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateAccountCommand extends Command
{
    /**
     * @var CreateAccount
     */
    private $createAccount;

    /**
     * CreateAccountCommand constructor.
     * @param CreateAccount $createAccount
     */
    public function __construct(CreateAccount $createAccount)
    {
        parent::__construct('app:create-account');
        $this->createAccount = $createAccount;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        $question = new Question('アカウント名を入力してください: ');
        $name = $helper->ask($input, $output, $question);

        $question = new Question('金額を入力してください: ');
        $money = $helper->ask($input, $output, $question);

        $accountId = $this->createAccount->execute($name, $money);
        $output->writeln(sprintf('<info>[OK]</info>アカウントの作成が完了しました。口座番号は「%s」です', $accountId));

    }


}