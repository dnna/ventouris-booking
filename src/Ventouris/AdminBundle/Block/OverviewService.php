<?php
namespace Cuaround\AdminBundle\Block;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

class OverviewService extends BaseBlockService {
    protected $container;

    public function __construct($name, EngineInterface $templating, $container) {
        $this->container = $container;
        parent::__construct($name, $templating);
    }

    protected function getDoctrine() {
        return $this->container->get('doctrine');
    }

    public function execute(BlockInterface $block, Response $response = null) {
        $users = $this->getDoctrine()->getEntityManager()->getRepository('Cuaround\UserBundle\Entity\User')->findAll(array());

        return $this->renderResponse('CuaroundAdminBundle:Block:overview.html.twig', array(
            'block' => $block,
            'users' => $users,
        ), $response);
    }

    public function buildEditForm(FormMapper $formMapper, BlockInterface $block) {}

    function validateBlock(ErrorElement $errorElement, BlockInterface $block) {}
}