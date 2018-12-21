<?php

namespace App\Command;


use Acme\Account\UseCase\ShowAccount;
use Acme\Account\UseCase\TransferMoney;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class TransferMoneyCommand extends Command
{
    /**
     * @var TransferMoney
     */
    private $transferMoney;

    /**
     * @var ShowAccount
     */
    private $showAccount;

    /**
     * TransferMoneyCommand constructor.
     * @param TransferMoney $transferMoney
     */
    public function __construct(TransferMoney $transferMoney, ShowAccount $showAccount)
    {
        parent::__construct('app:transfer-money');
        $this->transferMoney = $transferMoney;
        $this->showAccount = $showAccount;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        $question = new Question('送金元の口座番号を入力してください: ');
        $source = $helper->ask($input, $output, $question);

        $question = new Question('送金先の口座番号を入力してください: ');
        $destination = $helper->ask($input, $output, $question);

        $question = new Question('送金金額を入力してください: ');
        $money = $helper->ask($input, $output, $question);

        try {
            $this->transferMoney->execute($source, $destination, $money);
            $output->writeln('<info>[OK]</info>送金処理が完了しました');

            $output->writeln(sprintf('送金元の残高「%d円」です', $this->showAccount->execute($source)['balance']));
            $output->writeln(sprintf('送金先の残高「%d円」です', $this->showAccount->execute($destination)['balance']));
        } catch (\Exception $e) {
            $output->writeln('<error>[ERROR]</error>送金処理に失敗しました');
        }

    }


}