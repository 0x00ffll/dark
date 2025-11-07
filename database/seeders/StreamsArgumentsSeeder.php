<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StreamsArgumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Truncate table
        DB::table('streams_arguments')->truncate();

        $data = [
            [
                'id' => 1,
                'argument_cat' => 'fetch',
                'argument_name' => 'User Agent',
                'argument_description' => 'Set a Custom User Agent',
                'argument_wprotocol' => 'http',
                'argument_key' => 'user_agent',
                'argument_cmd' => '-user-agent "%s"',
                'argument_type' => 'text',
                'argument_default_value' => 'Xtream-Codes IPTV Panel Pro'
            ],
            [
                'id' => 2,
                'argument_cat' => 'fetch',
                'argument_name' => 'HTTP Proxy',
                'argument_description' => 'Set an HTTP Proxy in this format: ip:port',
                'argument_wprotocol' => 'http',
                'argument_key' => 'proxy',
                'argument_cmd' => '-http_proxy "%s"',
                'argument_type' => 'text',
                'argument_default_value' => null
            ],
            [
                'id' => 3,
                'argument_cat' => 'transcode',
                'argument_name' => 'Average Video Bit Rate',
                'argument_description' => 'With this you can change the bitrate of the target video. It is very useful in case you want your video to be playable on slow internet connections',
                'argument_wprotocol' => null,
                'argument_key' => 'bitrate',
                'argument_cmd' => '-b:v %dk',
                'argument_type' => 'text',
                'argument_default_value' => null
            ],
            [
                'id' => 4,
                'argument_cat' => 'transcode',
                'argument_name' => 'Average Audio Bitrate',
                'argument_description' => 'Change Audio Bitrate',
                'argument_wprotocol' => null,
                'argument_key' => 'audio_bitrate',
                'argument_cmd' => '-b:a %dk',
                'argument_type' => 'text',
                'argument_default_value' => null
            ],
            [
                'id' => 5,
                'argument_cat' => 'transcode',
                'argument_name' => 'Minimum Bitrate Tolerance',
                'argument_description' => '-minrate FFmpeg argument. Specify the minimum bitrate tolerance here. Specify in kbps. Enter INT number.',
                'argument_wprotocol' => null,
                'argument_key' => 'minimum_bitrate',
                'argument_cmd' => '-minrate %dk',
                'argument_type' => 'text',
                'argument_default_value' => null
            ],
            [
                'id' => 6,
                'argument_cat' => 'transcode',
                'argument_name' => 'Maximum Bitrate Tolerance',
                'argument_description' => '-maxrate FFmpeg argument. Specify the maximum bitrate tolerance here.Specify in kbps. Enter INT number.',
                'argument_wprotocol' => null,
                'argument_key' => 'maximum_bitrate',
                'argument_cmd' => '-maxrate %dk',
                'argument_type' => 'text',
                'argument_default_value' => null
            ],
            [
                'id' => 7,
                'argument_cat' => 'transcode',
                'argument_name' => 'Buffer Size',
                'argument_description' => '-bufsize is the rate control buffer. Basically it is assumed that the receiver/end player will buffer that much data so its ok to fluctuate within that much. Specify in kbps. Enter INT number.',
                'argument_wprotocol' => null,
                'argument_key' => 'bufsize',
                'argument_cmd' => '-bufsize %dk',
                'argument_type' => 'text',
                'argument_default_value' => null
            ],
            [
                'id' => 8,
                'argument_cat' => 'transcode',
                'argument_name' => 'CRF Value',
                'argument_description' => 'The range of the quantizer scale is 0-51: where 0 is lossless, 23 is default, and 51 is worst possible. A lower value is a higher quality and a subjectively sane range is 18-28. Consider 18 to be visually lossless or nearly so: it should look the same or',
                'argument_wprotocol' => null,
                'argument_key' => 'crf',
                'argument_cmd' => '-crf %d',
                'argument_type' => 'text',
                'argument_default_value' => null
            ],
            [
                'id' => 9,
                'argument_cat' => 'transcode',
                'argument_name' => 'Scaling',
                'argument_description' => 'Change the Width & Height of the target Video. (Eg. 320:240 ) .  If we\'d like to keep the aspect ratio, we need to specify only one component, either width or height, and set the other component to -1. (eg 320:-1)',
                'argument_wprotocol' => null,
                'argument_key' => 'scaling',
                'argument_cmd' => '-filter_complex "scale=%s"',
                'argument_type' => 'text',
                'argument_default_value' => null
            ],
            [
                'id' => 10,
                'argument_cat' => 'transcode',
                'argument_name' => 'Aspect',
                'argument_description' => 'Change the target Video Aspect. (eg 16:9)',
                'argument_wprotocol' => null,
                'argument_key' => 'aspect',
                'argument_cmd' => '-aspect %s',
                'argument_type' => 'text',
                'argument_default_value' => null
            ],
            [
                'id' => 11,
                'argument_cat' => 'transcode',
                'argument_name' => 'Target Video FrameRate',
                'argument_description' => 'Set the frame rate',
                'argument_wprotocol' => null,
                'argument_key' => 'video_frame_rate',
                'argument_cmd' => '-r %d',
                'argument_type' => 'text',
                'argument_default_value' => null
            ],
            [
                'id' => 12,
                'argument_cat' => 'transcode',
                'argument_name' => 'Audio Sample Rate',
                'argument_description' => 'Set the Audio Sample rate in Hz',
                'argument_wprotocol' => null,
                'argument_key' => 'audio_sample_rate',
                'argument_cmd' => '-ar %d',
                'argument_type' => 'text',
                'argument_default_value' => null
            ],
            [
                'id' => 13,
                'argument_cat' => 'transcode',
                'argument_name' => 'Audio Channels',
                'argument_description' => 'Specify Audio Channels',
                'argument_wprotocol' => null,
                'argument_key' => 'audio_channels',
                'argument_cmd' => '-ac %d',
                'argument_type' => 'text',
                'argument_default_value' => null
            ],
            [
                'id' => 14,
                'argument_cat' => 'transcode',
                'argument_name' => 'Remove Sensitive Parts (delogo filter)',
                'argument_description' => 'With this filter you can remove sensitive parts in your video. You will just specifiy the x & y pixels where there is a sensitive area and the width and height that will be removed. Example Use: x=0:y=0:w=100:h=77:band=10',
                'argument_wprotocol' => null,
                'argument_key' => 'delogo',
                'argument_cmd' => '-filter_complex "delogo=%s"',
                'argument_type' => 'text',
                'argument_default_value' => null
            ],
            [
                'id' => 15,
                'argument_cat' => 'transcode',
                'argument_name' => 'Threads',
                'argument_description' => 'Specify the number of threads you want to use for the transcoding process. Entering 0 as value will make FFmpeg to choose the most optimal settings',
                'argument_wprotocol' => null,
                'argument_key' => 'threads',
                'argument_cmd' => '-threads %d',
                'argument_type' => 'text',
                'argument_default_value' => null
            ],
            [
                'id' => 16,
                'argument_cat' => 'transcode',
                'argument_name' => 'Logo Path',
                'argument_description' => 'Add your Own Logo to the stream. The logo will be placed in the upper left. Please be sure that you have selected H.264 as codec otherwise this option won\'t work. Note that adding your own logo will consume A LOT of cpu power',
                'argument_wprotocol' => null,
                'argument_key' => 'logo',
                'argument_cmd' => '-i "%s" -filter_complex "overlay"',
                'argument_type' => 'text',
                'argument_default_value' => null
            ],
            [
                'id' => 17,
                'argument_cat' => 'fetch',
                'argument_name' => 'Cookie',
                'argument_description' => 'Set an HTTP Cookie that might be useful to fetch your INPUT Source.',
                'argument_wprotocol' => 'http',
                'argument_key' => 'cookie',
                'argument_cmd' => '-cookie \'%s\'',
                'argument_type' => 'text',
                'argument_default_value' => null
            ],
            [
                'id' => 18,
                'argument_cat' => 'transcode',
                'argument_name' => 'DeInterlacing Filter',
                'argument_description' => 'It check pixels of previous, current and next frames to re-create the missed field by some local adaptive method (edge-directed interpolation) and uses spatial check to prevent most artifacts.',
                'argument_wprotocol' => null,
                'argument_key' => '',
                'argument_cmd' => '-filter_complex "yadif"',
                'argument_type' => 'radio',
                'argument_default_value' => '0'
            ]
        ];

        // Insert data in chunks for better performance
        collect($data)->chunk(100)->each(function ($chunk) {
            DB::table('streams_arguments')->insert($chunk->toArray());
        });

        // Reset AUTO_INCREMENT for next insertion
        $maxId = DB::table('streams_arguments')->max('id') ?? 0;
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE streams_arguments AUTO_INCREMENT = ' . ($maxId + 1));
        }

        Schema::enableForeignKeyConstraints();
    }
}