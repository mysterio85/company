<?php

namespace App\Admin;

use App\Entity\Company;
use App\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class UserAdmin extends AbstractAdmin
{

    /**
     * Configuration des champs de formualires de création d'un utilisateur
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Utilisateur', ['class' => 'col-md-9'])
            ->add('firstName', TextType::class, ['label' => 'Prénom'])
            ->add('lastName', TextType::class, ['label' => 'Nom'])
            ->end()
            ->with('Entreprise', ['class' => 'col-md-3'])
            ->add('company', ModelType::class,
                [
                    'class'    => Company::class,
                    'property' => 'name',
                    'label'    => 'Entreprise'
                ])
            ->end();
    }

    /**
     * Configuration des filtres
     *
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('lastName', null, ['label' => 'Nom'])
            ->add('firstName', null, ['label' => 'Prénom'])
            ->add('company', null, [], EntityType::class, [
                'class'        => Company::class,
                'choice_label' => 'name',
                'label'        => 'Entreprise'
            ]);
    }

    /**
     * Configuration des champs d'affichage des Utilisateurs
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('lastName', null, ['label' => 'Nom'])
            ->add('firstName', null, ['label' => 'Prénom'])
            ->add('company.name', null, ['label' => 'Entreprise'])
            ->add('company.address', null, ['label' => 'Adresse Entreprise'])
            ->add('company.companyNumber', null, ['label' => 'Code Entreprise'])
            ->add('_action', null, [
                'actions' => [
                    'show'   => [],
                    'edit'   => [],
                    'delete' => [],
                ]
            ]);
    }

    /**
     * @param $object
     *
     * @return string
     */
    public function toString($object)
    {
        return $object instanceof User
            ? $object->getFirstName()
            : 'Utilisateur';
    }


    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Détails Utilisateur', [
                'class'     => 'col-md-6',
                'box_class' => 'box box-solid box-default',
            ])
            ->add('lastName', null, ['label' => 'Nom'])
            ->add('firstName', null, ['label' => 'Prénom'])
            ->end()
            ->with('Entreprise', [
                'class'     => 'col-md-6',
                'box_class' => 'box box-solid box-default',
            ])
            ->add('company.name', null, ['label' => 'Entreprise'])
            ->add('company.address', null, ['label' => 'Adresse Entreprise'])
            ->add('company.companyNumber', null, ['label' => 'Code Entreprise'])
            ->end();
    }


}