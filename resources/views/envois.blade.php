@extends('layouts.Client')
@section('contente')
<div class="grid-maxWidthInner no-padding">
    <h2 data-testid="shipping-as-headline" class="styled__headlineStyles-sc-18g9jku-0-h2 bTxDRk styled__StyledHeadline-sc-1pqhmhb-1 duDybK ">
        J’expédie en tant que…
    </h2>
    <ul class="styled__SegmentControlWrapper-sc-b77xzp-0 haUtTb" role="tablist">
        <li aria-controls="tradelane-panel" class="styled__SegmentedListWrapper-sc-b77xzp-1 iehxst">
            <a id="business" role="tab" aria-selected="false" data-testid="spot-shipment-business-tab" data-tracking="digitalLayer.gaq.spotShipment.selectedSegment" aria-labelledby="business" href="#business-tab" class="styled__SegmentedControlButton-sc-b77xzp-2 dIDKVs" data-di-id="#business"><span class="labelText">Professionnel</span></a>
        </li>
        <li aria-controls="tradelane-panel" class="styled__SegmentedListWrapper-sc-b77xzp-1 iehxst"><a id="private" role="tab" aria-selected="true" data-testid="spot-shipment-private-tab" data-tracking="digitalLayer.gaq.spotShipment.selectedSegment" aria-labelledby="private" href="#private-tab" class="styled__SegmentedControlButton-sc-b77xzp-2 dIDKVs" data-di-id="#private"><span class="labelText">Personne privée</span></a></li>
    </ul>
</div>
@endsection