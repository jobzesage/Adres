<?php if(isset($contact_types)) :?>
    <ul>
    <?php foreach ($contact_types as $contact_type) :?>
       <li><?php echo $html->link($contact_type['ContactType']['name'], array(
            'plugin'=>'emailer',
            'controller'=> 'main',
            'action'=>'show',
            $contact_type['ContactType']['id']
        ))?>
        </li>
    <?php endforeach?>
    </ul>
<?php endif ?>

<?php if(isset($logs)) : ?>
<table class="adres-datagrid ui-widget">

<?php
        $i = 0;
foreach ($logs as $log):
    $class = null;
if ($i++ % 2 == 1) {
    $class = ' class="tr-even"';
}
?>
    <tr<?php echo $class;?>>
        <td>
            <?php echo $log['EmailLog']['subject']; ?>
        </td>
        <td>
            <?php echo $log['EmailLog']['body']; ?>
        </td>
        <td>
            <?php echo $log['EmailLog']['sent_to']; ?> &nbsp;
        </td>
     </tr>
<?php endforeach; ?>
</table>
</div>

<?php endif ?>
