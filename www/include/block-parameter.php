<div id="block-parameter">
    <p class="header-title">Поиск по параметрам</p>
    <p class="title-filter">Стоимость</p>
        <form method="GET" action="search-filter.php">
            <div id="block-input-price">
                <ul>
                    <li><p>от</p></li>
                    <li><input type="text" id="start-price" name="start_price" value="1000"/></li>
                    <li><p>до</p></li>
                    <li><input type="text" id="end-price" name="end_price" value="3000000"/></li>
                    <li><p>руб</p></li>  
                </ul>
            </div>
            
            <div id="blocktrackbar"></div>
            <p class="title-filter">Производители</p>
                <ul class="checkbox-markauto">
                    <li><input type="checkbox" id="checkmarkauto1" /><label for="checkmarkauto1">Audi</label></li>
                    <li><input type="checkbox" id="checkmarkauto2" /><label for="checkmarkauto2">Honda</label></li>
                    <li><input type="checkbox" id="checkmarkauto3" /><label for="checkmarkauto3">Toyota</label></li>
                </ul>
            <center><input type="submit" name="submit" id="button-param-search" value=""/></center>
        </form>
</div>