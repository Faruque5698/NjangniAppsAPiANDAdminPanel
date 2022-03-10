<footer class="main-footer">
    <div class="footer-left">
        @php($footer = \App\Models\GeneralSettings::find(1))
        Copyright &copy; 2022 <div class="bullet">{{$footer->footer_text}}</div>
    </div>
{{--    <div class="footer-right">--}}
{{--        2.3.0--}}
{{--    </div>--}}
</footer>
