<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- Halaman Statis --}}
    @foreach($staticRoutes as $r)
    <url>
        <loc>{{ $r['url'] }}</loc>
        <changefreq>{{ $r['freq'] }}</changefreq>
        <priority>{{ $r['priority'] }}</priority>
    </url>
    @endforeach

    {{-- Berita --}}
    @foreach($news as $item)
    <url>
        <loc>{{ route('berita.show', $item->slug) }}</loc>
        <lastmod>{{ $item->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

    {{-- Program Studi --}}
    @foreach($programs as $item)
    <url>
        <loc>{{ route('akademik.program-detail', $item->slug) }}</loc>
        <lastmod>{{ $item->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    {{-- Penelitian --}}
    @foreach($research as $item)
    <url>
        <loc>{{ route('penelitian.show', $item->slug) }}</loc>
        <lastmod>{{ $item->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    @endforeach

    {{-- Halaman Statis Kustom --}}
    @foreach($pages as $item)
    <url>
        <loc>{{ url('/halaman/' . $item->slug) }}</loc>
        <lastmod>{{ $item->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    @endforeach

</urlset>
