<?php

namespace App\Admin;

use App\Entity\Company;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class CompanyAdmin extends AbstractAdmin
{

    /**
     * Configuration des champs de formualires
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class, ['label' => 'Nom'])
            ->add('address', TextType::class, ['label' => 'Adresse postale'])
            ->add('companyNumber', TextType::class, ['label' => 'Code ']);
    }

    /**
     * Configuration des filtres
     *
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, ['label' => 'Nom'])
            ->add('address', null, ['label' => 'Adresse '])
            ->add('companyNumber', null, ['label' => 'Code ']);
    }

    /**
     * Configuration des champs d'affichage des Compagnies
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name', null, ['label' => 'Nom'])
            ->add('address', null, ['label' => 'Adresse '])
            ->add('companyNumber', null, ['label' => 'Code '])
            ->add('_action', null, [
                'actions' => [
                    'show'   => [],
                    'edit'   => [],
                    'delete' => [],
                ]
            ]);
    }

    /**
     * Configuration de l'affichage des détails d'une compagnie
     *
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Entreprise', [
                'class'     => 'col-md-12',
                'box_class' => 'box box-solid box-default',
            ])
            ->add('name', null, ['label' => 'Nom'])
            ->add('address', null, ['label' => 'Adresse '])
            ->add('companyNumber', null, ['label' => 'Code '])
            ->end();
    }


    /**
     * Conversion de l'objet en String
     *
     * @param $object
     *
     * @return string
     */
    public function toString($object)
    {
        return $object instanceof Company
            ? $object->getName()
            : 'Entreprise';
    }

}