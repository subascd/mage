<?php
/**
 *Product Inquiry Widget Grid
 */
class Imedia_ProductInquiry_Block_Adminhtml_Inquiry_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('id');
        $this->setId('imedia_productinquiry_inquiry_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _getCollectionClass()
    {
        return 'imedia_productinquiry/inquiry_collection';
    }

    protected function _prepareCollection()
    {
       
		$collection = Mage::getResourceModel($this->_getCollectionClass());
		$this->setCollection($collection);
	    return parent::_prepareCollection();
    
	}

    protected function _prepareColumns()
    {
       
		$this->addColumn('id',array(
                'header'=> Mage::helper('imedia_productinquiry')->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'id'
            )
        );
		
		$this->addColumn('product_name',
            array(
                'header'=> Mage::helper('imedia_productinquiry')->__('Product Name'),
                'index' => 'product_name'
            )
        );
		
		$this->addColumn('user_name',
            array(
                'header'=> Mage::helper('imedia_productinquiry')->__('User Name'),
                'index' => 'user_name'
            )
        );
        $this->addColumn('user_email',
            array(
                'header'=> Mage::helper('imedia_productinquiry')->__('User Email'),
                'index' => 'user_email'
            )
        );
		$this->addColumn('user_question',
            array(
                'header'=> Mage::helper('imedia_productinquiry')->__('User Question'),
                'index' => 'user_question'
            )
        );
		$this->addColumn('is_active',
            array(
                'header'=> Mage::helper('imedia_productinquiry')->__('Is Active'),
                'index' => 'is_active'
            )
        );
       
        $this->addColumn('action',
            array(
                'header'    => Mage::helper('imedia_productinquiry')->__('Action'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'     => 'getId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('imedia_productinquiry')->__('View'),
                        'url'     => array(
                            'base'=>'*/*/edit',
                            'params'=>array('store'=>$this->getRequest()->getParam('store'))
                        ),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
            ));

        return parent::_prepareColumns();
    }
    protected function _prepareMassAction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('id');
        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('imedia_productinquiry')->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
            'confirm' => Mage::helper('imedia_productinquiry')->__('Are you sure you want to delete the selected listing(s)?')
        ));
        return $this;
    }
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    }