<div id="cart-summary">
    <div class="subtotal">
        <span>Subtotal</span>
        <span>R$ {{ number_format($subtotal, 2, ',', '.') }}</span>
    </div>
    <div class="desconto">
        <span>Desconto</span>
        <span>R$ {{ number_format($desconto, 2, ',', '.') }}</span>
    </div>
    <div class="total">
        <span>Total</span>
        <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
    </div>
</div>
