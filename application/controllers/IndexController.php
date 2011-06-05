<?php
class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        // modelos
        $user = new User();
        $order = new Order();
        $orderItem = new OrderItem();

        // resgata usuários que tenham cadastrado 2 ou mais produtos
        $usersByQtdProduct = $user->findByQtdProduct(2);
        $this->view->assign('usersByQtdProduct', $usersByQtdProduct);

        // resgata um pedido, usuário que realizou e produtos com a quantidade
        $pedido = $order->find(1)->current();
        $pedido_user = $pedido->findParentRow('User');
        $pedido_itens = $orderItem->findByOrder($pedido->order_id);
        $this->view->assign('pedido', $pedido);
        $this->view->assign('pedido_user', $pedido_user);
        $this->view->assign('pedido_itens', $pedido_itens);
    }
}