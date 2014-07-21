<?php

class dropdown extends database{
    
    public function create($attr=array('sql','name'=>NULL,'id'=>NULL,'value'=>NULL,'class'=>NULL,
                        'option_select'=>NULL,'option_all'=>NULL,'val'=>NULL,'label'=>NULL,'disabled'=>NULL)){
        $data = $this->fetchdata($attr['sql']);
        if(!isset($attr['id']))
            $attr['id'] = $attr['name'];
        if(!isset($attr['class']))
            $attr['class'] = 'input-medium';
        if(isset($attr['disabled']))
            $disabled = "disabled";
        else
            $disabled = "";
        
        echo "<select name='".$attr['name']."' id='".$attr['id']."' class='".$attr['class']."' $disabled>";
        
        if((isset($attr['option_all']))&&($attr['option_all']=='TRUE'))
            $attr['option_all'] = TRUE;
        else
            $attr['option_all'] = FALSE;
        if($attr['option_all'])
            echo "<option value=''>ALL</option>";
        
        if((isset($attr['option_select']))&&($attr['option_select']=='TRUE'))
            $attr['option_select'] = TRUE;
        else
            $attr['option_select'] = FALSE;
        if($attr['option_select'])
            echo "<option>Pilih</option>";
        
        foreach ($data as $dat) {
            if(!isset($attr['val']))
                $attr['val'] = 'id';
            if(!isset($attr['label'])){
                $attr['label'] = array('nama');
                $label = $dat['nama'];
            }
            else{
                $label = '';
                foreach($attr['label'] as $labels)
                    $label.= $dat[$labels].' ';
            }
                
            if((isset($attr['value']))&&($dat[$attr['val']]==$attr['value'])){
                    echo "<option value='".$dat[$attr['val']]."' selected='selected'>".$label."</option>";    
            }else{
                    echo "<option value='".$dat[$attr['val']]."'>".$label."</option>";    
            }
        }
        echo "</select>";
    }
    
    
}

?>
